<template>
  <section class="flex">
    <p>{{ comment }}</p>
    <span>{{ note }} / 5</span>
  </section>
</template>

<script>
export default {
  name: "Comment",
  props: {
    comment: String,
    note: Number,
  },
};
</script>

<style scoped>
.flex {
  display: flex;
  justify-content: space-around;
}
</style>
