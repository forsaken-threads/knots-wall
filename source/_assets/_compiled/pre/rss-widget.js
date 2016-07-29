Vue.component('rss-widget', {
    beforeCompile: function() {
        if (!Cookies.getJSON(this.btoa(this.url)).collapsed) {
            this.fetchFeed();
        }
    },
    data: function() {
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
        date: function(d, dateOnly) {
            d = new Date(d);
            if (dateOnly != undefined) {
                return d.toLocaleDateString();
            }
            return d.toLocaleDateString() + ' ' + d.toLocaleTimeString();
        }
    },
    methods: {
        btoa: function(value) {
            return btoa(value).replace('/', '-').replace('=', '_').replace('+', ':');
        },
        fetchFeed: function() {
            feednami.load(this.url, this.loadRss);
        },
        hide: function() {
            this.collapsed = true;
            this.save();
        },
        save: function() {
            Cookies.set(this.btoa(this.url), {
                articleLimit: this.articleLimit,
                collapsed: this.collapsed,
                start: this.start
            });
        },
        show: function() {
            this.collapsed = false;
            if (this.rss.entries.length == 0) {
                this.fetchFeed();
            }
            this.save();
        },
        loadRss: function(result) {
            if (result.error) {
                console.log(result.error);
            } else {
                this.rss = result.feed;
            }
        },
        scroll: function(direction) {
            this.start = this.start + (this.articleLimit * parseInt(direction));
            this.save();
        }
    },
    props: {
        'title': null,
        'url': null
    },
    ready: function() {
        $('#' + this.btoa(this.url)).on('show.bs.collapse', this.show).on('hide.bs.collapse', this.hide);
    },
    template: require('../pre/rss-widget.html'),
    watch: {
        articleLimit: function(newVal, oldVal) {
            this.start = 0;
            this.save();
        }
    }
});