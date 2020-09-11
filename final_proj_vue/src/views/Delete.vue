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
                <!-- on this page, just the campaign name and total price indicator(not working) -->
                <template>
                  <v-row>
                    <v-col cols="12" sm="6" md="3" lg="12" xl="12">

                    </v-col>
                    <v-spacer></v-spacer>
                    <v-col cols="12" sm="6" md="3" lg="12" xl="12">

                    </v-col>
                    <v-col cols="12" sm="6" md="3" lg="12" xl="12">
                      <v-text-field
                        v-model="campaignName"
                        label="Campaign name"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="3" lg="12" xl="12">
                      <p
                      >The total price is {{totalPrice}}</p>
                    </v-col>
                  </v-row>
                </template>
                <!-- booking delete as well as the logout button -->
                <v-list-item>
                  <v-btn @click="validate" block>Delete</v-btn>
                </v-list-item>

              </v-list>

            <template v-slot:append>
              <div class="pa-2">
                <v-btn @click="logOut" block>Logout</v-btn>
                {{ campaignId }}{{ campaignName }}
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
            :headers="headers"
            :items="campaigns"
            :single-select="singleSelect"
            class="elevation-1"
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
    name: 'Delete',
      props: {
  },
data () {
    return {
      currentUser: "Admin",
      singleSelect: true,
      campaignId: [],
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
      // validation for the delete page
    validate: function() {  
      if(this.campaignId.length < 1){
        alert("A campaign must be selected.");
        return;
      }else
      this.makeSelection();
    },
    // as delete is single select, this function just records the campaign name and id on click
    select: function (item, row) {  
      console.log(item, row)
      if(row.isSelected === false){
      row.select(true)
      this.campaignId = [];
      this.campaignName = [];
      this.campaignId.push( row.item.id );
      this.campaignName.push( row.item.name );
      }
      else {
        (row.select(false))
      this.campaignId.splice(this.campaignId.indexOf(row.item.id), 1);
      this.campaignName.splice(this.campaignName.indexOf(row.item.name), 1);
      }
    },
    logOut: function() {  
      // Axios.get('http://localhost:8081/logout')
      location.href = 'http://localhost:8081/logout'

    },
    // the function which gathers and sends the data in order for a SQL delete query to be initiated
    makeSelection() {
        const params = { 
            id: this.campaignId[0], name: this.campaignName[0]
            };
        Axios.post('http://localhost:8081/api/bookingDelete', JSON.stringify(params),
            {
            headers: {
              'Content-Type': 'application/json'
              }
            })
          .then(response=>{
            console.log(response)
        // location.href = 'http://localhost:8080/home'
      })
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