var kwc = {
    data: {
        archivesPanel: { },
        collectionPanels: { },
        twoQuickNotesCollapsed: false,
        twoQuickNotesViewed: 0
    },
    get: function(key, def) {
        if (this.data[key] == undefined) {
            return def;
        }
        return this.data[key];
    },
    getIndex: function(key, index, def) {
        if (this.data[key] == undefined || this.data[key][index] == undefined) {
            return def;
        }
        return this.data[key][index];
    },
    create: function() {
        if (Cookies.get('settings') == undefined) {
            this.save();
        } else {
            var data = Cookies.getJSON('settings');
            for (var key in data) {
                if (data.hasOwnProperty(key)) {
                    if (this.data[key] == undefined) {
                        delete data[key];
                    }
                }
            }
            this.data = data;
        }
    },
    has: function(key) {
        return this.data[key] != undefined;
    },
    increment: function(key, max) {
        if (max != undefined && parseInt(this.get(key, 0)) > parseInt(max)) {
            return;
        }
        this.set(key, parseInt(this.get(key, 0)) + 1);
    },
    init: function(key, value) {
        if (this.get(key) == undefined) {
            this.set(key, value);
        }
    },
    save: function() {
        Cookies.set('settings', this.data);
    },
    set: function(key, value) {
        this.data[key] = value;
        this.save();
    },
    setIndex: function(key, index, value) {
        if (!this.has(key)) {
            this.data[key] = { };
        }
        this.data[key][index] = value;
        this.save();
    },
    toggle: function(key) {
        this.set(key, !this.get(key));
    }
};

kwc.create();
