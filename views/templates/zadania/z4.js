document.addEventListener('alpine:init', () => {
    Alpine.data('z4', (last_item) => ({
        show: 0,

        change:function(id){
            
            if(id==this.show+1){
                this.show++
            }
            // console.log(this.last_item);
            if(this.show==last_item-1){
                this.show=id
            }
        },
    }))
})