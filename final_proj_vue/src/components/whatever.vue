<template>
  <v-container fluid class="contcolor">
    <v-row>
      <!-- <span class="bg"></span> -->
      <v-col 
        cols="12"
        xl="3"
        lg="4"
        sm="12"
        xs="12"
        pr-1
        >
        <v-card
        class="mx-auto"
        height="710"
        width="550"
        >
          <v-navigation-drawer
            class="blue-grey darken-1"
            width="550"
            fluid
            dark
            permanent
          >
            <v-list>
              <v-list-item
                text-center
              >
                
                  <h2>Welcome user.</h2>
                </v-list-item>

                  <v-list-item>
                    <img src="../../public/img/logo.png" alt="" style="height: 210px" class="mx-auto">
                </v-list-item>

                <v-list-item>
                  <p>To create a booking, click on the board entries you would like to reserve. Select a start and end date for your campaign, as well as its name.
                    The total price will be displayed below. To finish, simply click the Confirm button below.</p>
                </v-list-item>

                  <v-list-item>
                  <label for="startDate">Start date</label>
                  <input type="date" id="startDate" name="startDate" v-model="startDate">
                </v-list-item>


                <v-list-item>
                  <label for="endDate">End date</label>
                  <input type="date" id="endDate" name="endDate" v-model="endDate">
                </v-list-item>

                <v-list-item>
                  <label for="campaignName">Campaign name</label>
                  <input type="text" id="campaignName" name="campaignName" placeholder="My Campaign" v-model="campaignName">
                </v-list-item>

                <v-list-item>
                  <v-list-item-title>Total price</v-list-item-title>
                  <v-list-item-subtitle>{{ totalPrice }}</v-list-item-subtitle>
                </v-list-item>

                <v-list-item>
                  <v-btn block>Confirm</v-btn>
                </v-list-item>

              </v-list>

            <template v-slot:append>
              <div class="pa-2">
                <v-btn block>Logout</v-btn>
              </div>
            </template>

          </v-navigation-drawer>
        </v-card>
      </v-col>

      <v-col
        cols="12"
        xl="9"
        lg="8"
        sm="12"
        xs="12"
        >
        <v-simple-table dark height="710">

        <v-data-table
            v-model="selected"
            :headers="headers"
            :items="boards"
            :single-select="singleSelect"
            item-key="name"
            show-select
            class="elevation-1"
        >
            <template v-slot:top>
            <v-switch v-model="singleSelect" label="Single select" class="pa-3"></v-switch>
            </template>
        </v-data-table>
        </v-simple-table>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import Axios from 'axios'
  export default {
    name: 'Boards',
      props: {
  },
data () {
    return {
      startDate: "",
      endDate: "",
      campaignName: "",
      boards: [],
      totalPrice: 0,
      headers: [
        {
          text: 'Board ID',
          align: 'left',
          sortable: false,
          value: 'boardCode'
        },
        { text: 'Board size', value: 'size' },
        { text: 'Board type', value: 'type' },
        { text: 'Location', value: 'location' },
        { text: 'Location type', value: 'locationType' },
        { text: 'Board price', value: 'price' },
      ],
    }
  },
    methods:{
  },
  beforeMount(){
    Axios.get('http://localhost:8081/')
      .then(response=>{
        this.boards = response.data
      })
    }
  }
</script>


<style lang="stylus" scoped>

  li {
    list-style: none;
  }
  
.contcolor {
  background-color: black;
}

.center {
  display: flex;
  justify-content: center;
}

.bg {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background: url( 'https://cdn.shopify.com/s/files/1/0083/0586/8918/products/T3_2048x.jpg?v=1542139351')  center;
    background-size: cover;
    background-color: red;
    transform: scale(1.1);
    z-index: -1;
  }


</style>