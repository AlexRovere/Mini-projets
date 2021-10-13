<template>
  <section class="recipe">
    <h1>{{ recipeName }}</h1>
    <p>{{ recipeDescription }}</p>
  </section>
  <section>
    <slot></slot>
  </section>
</template>

<script>
export default {
  name: "step",
  props: {
    recipeDescription: String,
    recipeName: String,
  },
};
</script>

<style>
.recipe {
  color: red;
}
</style>
