<template>
  <div class="card mb-3">
    <div class="card-body">
      <h5 class="card-title">{{ item.name }}</h5>
      <p class="card-text">{{ item.formatted_address }}</p>
    </div>
  </div>
</template>

<style scoped>
.card:hover {
  background-color: #007bff;
  color: white;
  cursor: pointer;
}
</style>

<script>
export default {
  // define props
  props: ["item"]
};
</script>
