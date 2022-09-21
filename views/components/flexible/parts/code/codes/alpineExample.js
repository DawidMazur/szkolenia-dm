document.addEventListener('alpine:init', () => {
  Alpine.data('exampleForm', () => ({
    name: '',

    loading: false,

    html: '',

    submit: function () {
      this.loading = true;
      this.html = 'Ładuję: ' + this.name;

      let form = this;

      jQuery.ajax({
        type: 'POST',
        url: wp_data.ajax,
        data: {
          action: 'find_post',
          data: {
            name: form.name,
          },
        },

        success: function (response) {
          console.log(response);
          form.html = response.message;
          form.loading = false;
        },
      });

      //   const findPosts = async () => {
      //     const response = await fetch(wp_data.ajax, {
      //       method: 'POST',
      //       data: {
      //         action: 'find_post',
      //         data: {
      //           name: form.name,
      //         },
      //       },
      //     });

      //     console.log(response);
      //   };

      //   findPosts();
    },
  }));
});
