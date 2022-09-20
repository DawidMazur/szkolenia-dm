document.addEventListener('alpine:init', () => {
    Alpine.data('exampleForm', () => ({
        name: '',
        
        loading: false,

        html: '',

        submit: function() {
            this.loading = true;
            this.html = 'Ładuję: ' + this.name;

            // todo ajax request
        }
    }))
})