<template>
  <label for="comment">Rédiger votre commentaire :</label>
  <textarea label="comment" type="text" />
  <label for="number">Note :</label>
  <input type="number" max="5" min="1" />
</template>

<script>
export default {
  name: "AddComment",
};
</script>

<style scoped>
.flex {
  display: flex;
  justify-content: space-around;
}
</style>
