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