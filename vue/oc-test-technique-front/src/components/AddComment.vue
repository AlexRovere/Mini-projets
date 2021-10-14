<template>
  <section class="flex">
    <div class="d-row">
      <label for="comment">Rédiger votre commentaire :</label>
      <textarea
        :v-model="newContent"
        id="newContent"
        name="content"
        label="comment"
        type="text"
        @keyup="changeContent"
      />
    </div>
    <div>
      <label for="number">Note :</label>
      <input
        :v-model="newNote"
        name="note"
        id="newNote"
        type="number"
        @keyup="changeNote"
      />
    </div>
    <div>
      <button type="send" @click="sendComment(newContent, newNote)">
        Envoyer
      </button>
    </div>
  </section>
</template>

<script>
export default {
  name: "AddComment",
  props: {
    sendComment: Function,
  },
  data() {
    return {
      newContent: "",
      newNote: "",
    };
  },
  methods: {
    changeContent() {
      this.newContent = document.getElementById("newContent").value;
    },
    changeNote() {
      this.newNote = document.getElementById("newNote").value;
    },
  },
};
</script>

<style scoped>
.flex {
  display: flex;
  justify-content: space-around;
}
.d-row {
  display: flex;
  flex-direction: row;
  align-items: center;
}
#newContent {
  width: 300px;
}
#newNote {
}
</style>
