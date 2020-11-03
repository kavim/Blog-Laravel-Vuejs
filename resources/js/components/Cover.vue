
<template>
    <div class="row">
      <div class="col-12 text-center px-5">
          <img id="blah" :src="this.image.src" class="img-fluid rounded col-6 col-sm-12" />
          <label for="file-upload" class="btn btn-success mt-2">
            <i class="fa fa-cloud-upload"></i> Alterar
          </label>
          <input id="file-upload" type="file" name="image" accept="image/jpeg, image/jpg, image/png" v-on:change="onImageChange" />
      </div>
    </div>
</template>
<script>
export default {
  data() {
    return {
      image: this.$store.state.cover,
    };
  },
  methods: {
    onImageChange(e) {
      this.image.data = e.target.files[0];

      const image = e.target.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(image);

      reader.onload = (e) => {
        this.image.src = e.target.result;
      };

      this.image.update = 1;

      this.syncdata();
    },
    syncdata: function() {
        this.$store.dispatch("setCover", this.image);
    },

  }
};
</script>
