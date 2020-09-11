<template>
  <div class="home">
    <!-- test div -->
    <div class="banner"><h1></h1></div>
  </div>
</template>

<script>
// @ is an alias to /src

export default {
  name: 'Home',
  components: {
  }
  
}
</script>

<style lang="stylus" scoped>

.home {
    height: 100%;
    width: 100%;
    margin-top: 38px;
    background: url( 'https://www.bartush.com/wp-content/uploads/2016/12/bigstock-147560168.jpg')  center;
    background-size: cover;
    background-color: black;
    transform: scale(1.1);
    z-index: -1;
  }

  .home {
    position: absolute;
    z-index: 1;
  }


</style>
