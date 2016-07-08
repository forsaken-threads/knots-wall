(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

Vue.component('rss-widget', {
    beforeCompile: function beforeCompile() {
        if (!Cookies.getJSON(this.btoa(this.url)).collapsed) {
            this.fetchFeed();
        }
    },
    data: function data() {
        if (Cookies.getJSON(this.btoa(this.url)) == undefined) {
            Cookies.set(this.btoa(this.url), {
                articleLimit: 5,
                collapsed: true,
                start: 0
            });
        }
        return {
            articleLimit: Cookies.getJSON(this.btoa(this.url)).articleLimit,
            collapsed: Cookies.getJSON(this.btoa(this.url)).collapsed,
            start: Cookies.getJSON(this.btoa(this.url)).start,
            rss: {
                entries: [],
                meta: {
                    update: 'never'
                }
            }
        };
    },
    filters: {
        date: function date(d, dateOnly) {
            d = new Date(d);
            if (dateOnly != undefined) {
                return d.toLocaleDateString();
            }
            return d.toLocaleDateString() + ' ' + d.toLocaleTimeString();
        }
    },
    methods: {
        btoa: function (_btoa) {
            function btoa(_x) {
                return _btoa.apply(this, arguments);
            }

            btoa.toString = function () {
                return _btoa.toString();
            };

            return btoa;
        }(function (value) {
            return btoa(value).replace('/', '-').replace('=', '_').replace('+', ':');
        }),
        fetchFeed: function fetchFeed() {
            feednami.load(this.url, this.loadRss);
        },
        hide: function hide() {
            this.collapsed = true;
            this.save();
        },
        save: function save() {
            Cookies.set(this.btoa(this.url), {
                articleLimit: this.articleLimit,
                collapsed: this.collapsed,
                start: this.start
            });
        },
        show: function show() {
            this.collapsed = false;
            if (this.rss.entries.length == 0) {
                this.fetchFeed();
            }
            this.save();
        },
        loadRss: function loadRss(result) {
            if (result.error) {
                console.log(result.error);
            } else {
                this.rss = result.feed;
            }
        },
        scroll: function scroll(direction) {
            this.start = this.start + this.articleLimit * parseInt(direction);
            this.save();
        }
    },
    props: {
        'title': null,
        'url': null
    },
    ready: function ready() {
        $('#' + this.btoa(this.url)).on('show.bs.collapse', this.show);
        $('#' + this.btoa(this.url)).on('hide.bs.collapse', this.hide);
    },
    template: require('../pre/rss-widget.html'),
    watch: {
        articleLimit: function articleLimit(newVal, oldVal) {
            this.start = 0;
            this.save();
        }
    }
});
Vue.component('text-snippet', {
    beforeCompile: function beforeCompile() {
        this.fullText = this.fullText.replace(/(<([^>]+)>)/ig, "");
    },
    data: function data() {
        return { max: 150 };
    },
    filters: {
        snippet: function snippet(value) {
            return value.substr(0, this.max).match(/.+\s/);
        }
    },
    methods: {
        fits: function fits() {
            return this.fullText.length < this.max;
        }
    },
    props: ['full-text'],
    template: require('../pre/text-snippet.html')
});


},{"../pre/rss-widget.html":2,"../pre/text-snippet.html":3}],2:[function(require,module,exports){
module.exports = '<div class="panel panel-default">\n    <div class="panel-heading">\n        <button class="btn btn-block" data-toggle="collapse" href="#{{ btoa(url) }}" aria-expanded="false" aria-controls="{{ btoa(url) }}">\n            <span class="pull-right"><i class="fa" :class="[collapsed ? \'fa-caret-square-o-down\': \'fa-caret-square-o-up\']"></i></span>\n            <i class="fa fa-rss-square"></i> {{ title }}\n        </button>\n    </div>\n    <div id="{{ btoa(url) }}" class="panel-body collapse" :class="{ \'in\': !collapsed }">\n        <div class="well well-sm" v-if="rss.entries.length">\n            <dl>\n                <template v-for="entry in rss.entries | limitBy articleLimit start">\n                    <dt>\n                        <a class="pull-right" :href="entry.link"><i class="fa fa-external-link text-primary"></i></a>\n                        {{ entry.title }} : {{ entry.date | date true }}\n                    </dt>\n                    <dd><text-snippet :full-text="entry.summary"></text-snippet></dd>\n                </template>\n            </dl>\n        </div>\n        <div v-else class="well well-sm text-center"><i class="fa fa-spinner fa-spin fa-4x"></i></div>\n        <div class="form-inline">\n            <button @click="scroll(-1)" type="button" class="btn pull-left" :disabled="start == 0"><i class="fa fa-arrow-left"></i></button>\n            <button @click="scroll(1)" type="button" class="btn pull-right" :disabled="start + articleLimit >= rss.entries.length"><i class="fa fa-arrow-right"></i></button>\n            <div class="text-center">\n                <label for="{{ btoa(url) }}ArticleLimit">Showing:</label>\n                <select class="form-control" id="{{ btoa(url)}}ArticleLimit" v-model="articleLimit" number>\n                    <option v-for="n in 3" :value="(n + 1) * 5">{{ (n + 1) * 5 }}</option>\n                </select>\n            </div>\n        </div>\n        <h6>Last Update: {{ rss.meta.date | date }}</h6>\n    </div>\n</div>';
},{}],3:[function(require,module,exports){
module.exports = '<span v-if="fullText.length < max">\n    {{{ fullText }}}\n</span>\n<span v-else>\n    {{{ fullText | snippet }}}&hellip;\n</span>';
},{}]},{},[1]);

//# sourceMappingURL=app.js.map
