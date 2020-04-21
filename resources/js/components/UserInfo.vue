<template>
  <div class="author float-right">
    <!-- $label ." ". $model->created_date  -->
    <span class="text-muted">{{postDate}}</span>
    <div class="media">
      <a :href="user.url" class="d-flex align-self-bottom" >
          <img :src="user.avatar" alt="User Avatar">
      </a>
      <div class="media-body">
        <a :href="user.url" style="font-size:1.4em;">{{user.name}}</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['model', 'label'],
  computed: {
    postDate() {
      return this.label + " " + this.model.created_date;
    },
  },
  data(){
    return {
      user: this.model.user
    }
  }
}
</script>