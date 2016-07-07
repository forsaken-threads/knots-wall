Vue.component('rss-widget', {
    data: function() {
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
        date: function(d, dateOnly) {
            d = new Date(d);
            if (dateOnly != undefined) {
                return d.toLocaleDateString();
            }
            return d.toLocaleDateString() + ' ' + d.toLocaleTimeString();
        }
    },
    methods: {
        loadRss: function(result) {
            if (result.error) {
                console.log(result.error);
            } else {
                console.log(result.feed.entries);
                this.rss = result.feed;
            }
        },
        scroll: function(direction) {
            this.start = this.start + (this.limit * direction);
        }
    },
    props: {
        limit: {
            default: function () {
                return 5;
            }
        },
        start: {
            default: function() {
                return 0;
            }
        },
        url: null
    },
    ready: function() {
        feednami.load(this.url, this.loadRss);
    },
    template: require('../pre/rss-widget.html')
});
Vue.component('text-snippet', {
    beforeCompile: function() {
        this.fullText = this.fullText.replace(/(<([^>]+)>)/ig,"");
    },
    data: function() {
        return { max: 150 };
    },
    filters: {
        snippet: function (value) {
            return value.substr(0, this.max).match(/.+\s/);
        }
    },
    methods: {
        fits: function() {
            return this.fullText.length < this.max;
        }
    },
    props: ['full-text'],
    template: require('../pre/text-snippet.html')
});
//# sourceMappingURL=app.js.map
