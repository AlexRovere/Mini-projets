<template>
  <Step :recipeName="name" :recipeDescription="description">
    <div class="flex" v-for="(item, index) in steps" :key="index">
      <div class="number-step">{{ item.number }}</div>
      <div>
        <h2>{{ item.title }}</h2>
        <h3>Description</h3>
        <p>{{ item.description }}</p>
        <h3 v-if="item.ingredients">Related ingredients</h3>
        <p v-for="(item, index) in item.ingredients" :key="index">
          Ingrédient {{ index + 1 }} = {{ item.name }} {{ item.quantity }}
          {{ item.metrics }}
        </p>
      </div>
      <div><img class="img-step" :src="item.image" /></div>
    </div>

    <p>that's it !</p>
  </Step>

  <p>Note moyenne : {{ countAverage }} / 5</p>

  <Comment
    v-for="(item, index) in comments"
    :key="index"
    :comment="item.content"
    :note="item.note"
  />
  <add-comment />
</template>

<script>
import axios from "axios";
import Step from "./components/step.vue";
import Comment from "./components/Comment.vue";
import AddComment from "./components/AddComment.vue";

export default {
  name: "App",
  components: {
    Step,
    Comment,
    AddComment,
  },
  data() {
    return {
      name: String,
      description: String,
      steps: [],
      comments: [],
    };
  },
  computed: {
    countAverage() {
      let total = 0;
      let iteration = 0;
      this.comments.forEach((element, index) => {
        total = total + element.note;
        iteration += index;
      });
      return (total = total / iteration).toFixed(1);
    },
  },
  mounted() {
    axios
      .get("http://localhost/Mini-projets/vue/data.json")
      .then(
        (response) => (
          (this.name = response["data"]["data"]["name"]),
          (this.description = response["data"]["data"]["description"]),
          (this.steps = response["data"]["data"]["steps"]),
          (this.comments = response["data"]["data"]["comments"])
        )
      );
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}

.number-step {
  background-color: red;
  color: white;
  border-radius: 50%;
  padding: 10px;
}

.flex {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  width: 60vw;
  margin: auto;
  align-items: center;
  text-align: justify;
  border-style: groove;
  border-radius: 5px;
}

.flex div:nth-child(2) {
  min-width: 30vw;
}

.img-step {
  width: 20vw;
  height: 40vh;
  object-fit: fill;
}

@media (max-width: 780px) {
  .flex {
    flex-direction: column;
  }
  .img-step {
    width: 200px;
    height: 220px;
  }
}
</style>
