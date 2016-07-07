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