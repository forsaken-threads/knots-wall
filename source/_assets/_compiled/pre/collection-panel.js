Vue.component('collection-panel', {
    data : function() {
        return {
            collapsed: undefined
        };
    },
    methods: {
        hide: function(e) {
            if (e.target.id != this.name) {
                return;
            }
            this.collapsed = true;
            kwc.setIndex('collectionPanels', this.name, { collapsed: true });
        },
        show: function(e) {
            if (e.target.id != this.name) {
                return;
            }
            this.collapsed = false;
            kwc.setIndex('collectionPanels', this.name, { collapsed: false });
        }
    },
    beforeCompile: function() {
        this.collapsed = kwc.getIndex('collectionPanels', this.name, { collapsed: this.collapsedDefault }).collapsed;
    },
    props: {
        collapsedDefault: {
            type: Boolean,
            default: true
        },
        name : {
            type: String
        }
    },
    ready: function() {
        $('#' + this.name).on('show.bs.collapse', this.show).on('hide.bs.collapse', this.hide);
    },
    template: require('../pre/collection-panel.html')
});
