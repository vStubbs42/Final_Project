<template>
  <v-app>
  <v-card color="orange darken-1">
    <v-card-title class=" fix text-center justify-center py-6">
      <h1 class="wordbreak col-xs-12 font-weight-bold display-3 black--text">CAMPAIGN MANAGER</h1>
    </v-card-title>

    <v-tabs
      v-resize="onResize"
      v-model="tab"
      background-color="transparent"
      color="black"
      grow
      :vertical="this.windowSize.x < 815"
      class="text-wrap"
    >
      <v-tab @click="moveToHome">
        <p>Home</p>
      </v-tab>

      <v-tab @click="moveToCreate">
        <p>Create campaign</p>
      </v-tab>

      <v-tab @click="moveToView">
        <p>View/Edit campaign</p>
      </v-tab>

      <v-tab @click="moveToDelete">
        <p>Delete campaign</p>
      </v-tab>
    </v-tabs>

    <v-tabs-items v-model="tab">
      <v-tab-item>
        <v-card
          color="blue-grey darken-1"
          flat>
          <v-card-text>Welcome to the Screen Media campaign manager! If you are new, just click the Create campaign button to get started.</v-card-text>
        </v-card>
      </v-tab-item>

      <v-tab-item>
        <v-card
          color="blue-grey darken-1"
          flat>
          <v-card-text>To create a booking, select the desired boards from the list, the dates when it should commence 
            and end, as well as a name for your campaign.</v-card-text>
        </v-card>
      </v-tab-item>

      <v-tab-item>
        <v-card
          color="blue-grey darken-1"
          flat>
          <v-card-text>To review your extant campaigns, just click on the desired one from the list (not working though)</v-card-text>
        </v-card>
      </v-tab-item>

      <v-tab-item>
        <v-card
          color="blue-grey darken-1"
          flat>
          <v-card-text>To delete a campaign, just select one from the list, and click the delete button. If the booking has already started, we regret to inform you that your advance is at this point not refundable.</v-card-text>
        </v-card>
      </v-tab-item>
    </v-tabs-items>
  </v-card>

    <v-main>
        <router-view />
    </v-main>
  </v-app>
</template>

<script>

export default {
  name: 'App',

  components: {
  },
    data () {
      return {
        windowSize: {
          x: 0,
          y: 0
        },
        tab: null,
        size: 0,
        items: [
          'Create campaign', 'View existing campaigns', 'Delete campaign', 'Edit campaign',
        ],
      }
    },
    methods: {
    onResize () {
      this.windowSize = { x: window.innerWidth, y: window.innerHeight }
    },
    moveToCreate () {
      this.$router.push('/createCampaign') 
      },
    moveToView () {
      this.$router.push('/editCampaign') 
      },
    moveToDelete () {
      this.$router.push('/deleteCampaign') 
      },
    moveToHome () {
      this.$router.push('/home') 
      }
    }
  }
</script>

<style>
/* Helper classes */
.basil {
  background-color: #FFFBE6 !important;
}
.basil--text {
  color: #356859 !important;
}
.fix {
    overflow-wrap: anywhere;
    word-wrap: break-word;
    word-break: normal;
    hyphens: auto;
}
.wordbreak {
  word-break: break-all; 
}
</style>
