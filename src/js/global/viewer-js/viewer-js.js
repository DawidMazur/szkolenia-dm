class ViewerJs {
    constructor (init = true) {
        if(init) {
            this.reinit();
        }
    }

    search() {
        this.objs = document.querySelectorAll('[data-js-viewer-js]');
    }

    reinit() {
        this.search();
        this.init();
    }

    init() {
        // checking if class ViewerJs exists
        if (typeof Viewer !== 'function') {
            console.error('Nie znaleziono klasy ViewerJS');
            return false;
        }

        if (this.objs) {
            this.objs.forEach(e => {
                const viewerJS = new Viewer(e, {
                    navbar: true,
                    filter: function(image) {
                        if(e.dataset.viewerFilter) {
                            if(image.dataset.viewer) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                        return true;
                    }
                });
            });
        }
        return true;
    }
}
const viewerJS = new ViewerJs();