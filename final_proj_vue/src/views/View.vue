<template>
  <v-container fluid class="contcolor">
    <v-row>
      <!-- the column containing the menu to the left hand side of the screen -->
      <v-col 
        cols="12"
        xl="3"
        lg="4"
        md="12"
        sm="12"
        xs="12"
        pr-1
        >
        <v-card
        class="mx-auto"
        >
          <v-navigation-drawer
            class="blue-grey darken-1"
            width=100%;
            dark
          >
            <v-list>
              <v-row>
                 <!-- menu header -->
                <v-col cols="12" sm="6" md="4" lg="12" xl="12">
                  <v-list-item>
                    <h2>Welcome {{ currentUser }}.</h2>
                  </v-list-item>
                 </v-col>

                 <v-col cols="12" sm="6" md="8" lg="12" xl="12">
                    <v-list-item>
                      <img src="../../public/img/logo.png" alt="" style="height: 180px" class="mx-auto">
                  </v-list-item>

                 </v-col> 
              </v-row>
              <!-- on this page, the add or remove booking buttons(not working) -->
                <template>
                  <v-row>
                    <v-col cols="12" sm="6" md="3" lg="12" xl="12">

                    </v-col>
                    <v-spacer></v-spacer>
                    <v-col cols="12" sm="6" md="3" lg="12" xl="12">

                    </v-col>
                    <v-col cols="12" sm="6" md="3" lg="12" xl="12">
                      <v-list-item>
                        <v-btn @click="add" block>Add new boards</v-btn>
                      </v-list-item>
                    </v-col>
                    <v-col cols="12" sm="6" md="3" lg="12" xl="12">
                      <v-list-item>
                        <v-btn @click="remove" block>Remove existing boards</v-btn>
                      </v-list-item>
                    </v-col>
                  </v-row>
                </template>

              </v-list>
            <!--logout button -->
            <template v-slot:append>
              <div class="pa-2">
                <v-btn @click="logOut" block>Logout</v-btn>
                {{ selected }}{{ campaignIds }}
              </div>
            </template>

          </v-navigation-drawer>
        </v-card>
      </v-col>
      <!-- the data table element -->
      <v-col
        cols="12"
        xl="9"
        lg="8"
        md="12"
        sm="12"
        xs="12"
        >
        <v-simple-table dark height="740">
          <v-data-table
          v-model="selected"
            :headers="headers"
            :items="campaigns"
            class="elevation-1"
            single-select = true
            :items-per-page="50"
            item-key="id"
            hide-default-footer
            @click:row="select"
          >
        


          </v-data-table>
        </v-simple-table>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import Axios from 'axios'
  export default {
    name: 'View',
      props: {
  },
data () {
    return {
      selected: [],
      currentUser: "Admin",
      campaignIds: [],
      startDate: "",
      endDate: "",
      campaignName: "",
      campaigns: [],
      totalPrice: "0",
      headers: [
        
        {text:'Campaign ID', value:'id'},
        {text:'Name', value:'name'},
        {text:'Total boards', value:'totalBoards'},
        {text:'Total price', value:'totalPrice'},
        
      ],
    }
  },
    methods:{
      // function leading to the add board page upon selection
    add() {
      const params = { 
          selectedCampaign: this.selected,
          };
      Axios.post('http://localhost:8081/api/bookingEdit', JSON.stringify(params),
          {
          headers: {
            'Content-Type': 'application/json'
            }
          })
        .then(response=>{
          console.log(response)
      location.href = 'http://localhost:8080/#/add'
    })
    },
    // function leading to the remove board page upon selection
    remove() {
      const params = { 
          selectedCampaign: this.selected,
          };
      Axios.post('http://localhost:8081/api/bookingEdit', JSON.stringify(params),
          {
          headers: {
            'Content-Type': 'application/json'
            }
          })
        .then(response=>{
          console.log(response)
      location.href = 'http://localhost:8080/#/remove'
    })
    },
    // single select for the campaign to be modified
    select: function (item, row) {  
      console.log(item, row)
      if(row.isSelected === false){
        row.select(true)
      }
      else {
        (row.select(false))
      }
    },
    logOut: function() {  
      // Axios.get('http://localhost:8081/logout')
      location.href = 'http://localhost:8081/logout'

    },
  },
  // fetches the campaign data from the database
  beforeMount(){
    Axios.get('http://localhost:8081/campaigns')
      .then(response=>{
        this.campaigns = response.data
      })
    },
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

    tr.v-data-table__selected {
    background: #7d92f5 !important;
  }


</style>