(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

Vue.component('rss-widget', {
    data: function data() {
        return {
            rss: {
                entries: [],
                meta: {
                    title: 'RSS Widget',
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
        loadRss: function loadRss(result) {
            if (result.error) {
                console.log(result.error);
            } else {
                console.log(result.feed.entries);
                this.rss = result.feed;
            }
        },
        scroll: function scroll(direction) {
            this.start = this.start + this.limit * direction;
        }
    },
    props: {
        limit: {
            default: function _default() {
                return 5;
            }
        },
        start: {
            default: function _default() {
                return 0;
            }
        },
        url: null
    },
    ready: function ready() {
        feednami.load(this.url, this.loadRss);
    },
    template: require('../pre/rss-widget.html')
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
module.exports = '<div class="panel panel-default">\n    <div class="panel-heading"><i class="fa fa-archive"></i> {{ rss.meta.title }}</div>\n    <div class="panel-body">\n        <dl>\n            <template v-for="entry in rss.entries | limitBy limit start">\n                <dt>\n                    <a class="pull-right" :href="entry.link"><i class="fa fa-external-link text-primary"></i></a>\n                    {{ entry.title }} : {{ entry.date | date true }}\n                </dt>\n                <dd><text-snippet :full-text="entry.summary"></text-snippet></dd>\n            </template>\n        </dl>\n        <div class="clearfix">\n            <button @click="scroll(-1)" type="button" class="btn pull-left" :disabled="start == 0"><i class="fa fa-arrow-left"></i></button>\n            <button @click="scroll(1)" type="button" class="btn pull-right" :disabled="start + limit > rss.entries.length"><i class="fa fa-arrow-right"></i></button>\n        </div>\n        <h6>Last Update: {{ rss.meta.date | date }}</h6>\n    </div>\n</div>';
},{}],3:[function(require,module,exports){
module.exports = '<span v-if="fullText.length < max">\n    {{ fullText }}\n</span>\n<span v-else>\n    {{ fullText | snippet }}&hellip;\n</span>';
},{}]},{},[1]);

//# sourceMappingURL=app.js.map
