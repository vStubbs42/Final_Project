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
                <!-- the date and campaign name pickers, as well as the total price indicator -->
                <template>
                  <v-row>
                    <v-col cols="12" sm="6" md="3" lg="12" xl="12">
                      <v-menu
                        :close-on-content-click="true"
                        :return-value.sync="date"
                        transition="scale-transition"
                        offset-y
                        min-width="290px"
                        dark
                      >
                        <template v-slot:activator="{ on, attrs }">
                          <v-text-field
                            v-model="startDate"
                            label="Start date"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                          ></v-text-field>
                        </template>
                        <v-date-picker :min="date" @change="getTotalPrice" v-model="startDate" scrollable>
                          <v-spacer></v-spacer>
                          <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
                          <v-btn text color="primary" @click="$refs.menu.save(date)">OK</v-btn>
                        </v-date-picker>
                      </v-menu>
                    </v-col>
                    <v-spacer></v-spacer>
                    <v-col cols="12" sm="6" md="3" lg="12" xl="12">
                      <v-menu
                        :close-on-content-click="true"
                        :return-value.sync="date"
                        transition="scale-transition"
                        offset-y
                        min-width="290px"
                        dark
                      >
                        <template v-slot:activator="{ on, attrs }">
                          <v-text-field
                            v-model="endDate"
                            label="End date"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                          ></v-text-field>
                        </template>
                        <v-date-picker :min="date2" @change="getTotalPrice" v-model="endDate" scrollable>
                          <v-spacer></v-spacer>
                          <v-btn text color="primary" @click="modal = false">Cancel</v-btn>
                          <v-btn text color="primary" @click="$refs.dialog.save(date)">OK</v-btn>
                        </v-date-picker>
                      </v-menu>
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
                <!-- booking confirm as well as the logout button -->
                <v-list-item>
                  <v-btn @click="validate" block>Confirm</v-btn>
                </v-list-item>

              </v-list>

            <template v-slot:append>
              <div class="pa-2">
                <v-btn @click="logOut" block>Logout</v-btn>
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
            :items="boards"
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
    name: 'Create',
      props: {
  },
data () {
    return {
      currentUser: "Admin",
      date: new Date().toISOString().substr(0, 10),
      date2: new Date(Date.now() + 604800000).toISOString().substr(0, 10),
      ddate:[],
      ddate2:[],
      boardSelection: [],
      boardPrices: "0",
      factor: "",
      dateDiff: "",
      startDate: "",
      endDate: "",
      campaignName: "",
      boards: [],
      totalPrice: "0",
      totalBoards: "0",
      headers: [
        
        {text:'Board ID', value:'boardCode'},
        {text:'Board size', value:'size'},
        {text:'Board type', value:'type'},
        {text:'Location', value:'location'},
        {text:'Location type', value:'locationType'},
        {text:'Weekly price', value:'price'},
        
      ],
    }
  },
    methods:{
      // validation for the create page
    validate: function() {  
      if(this.campaignName === ""){
        alert("A campaign name must be selected.");
        return;
      }
      if(this.boardSelection.length < 1){
        alert("At least one board must be selected.");
        return;
      }else
      this.makeSelection();
    },
    // selects the board entries, placing board id in one array, and adding its base price to another
    select: function (item, row) {  
      console.log(item, row)
      if(row.isSelected === false){
      row.select(true)
      this.boardSelection.push( row.item.id );
      this.boardPrices = parseInt(this.boardPrices) + parseInt(row.item.price)
      this.getTotalPrice();
      }
      else {
        (row.select(false))
      this.boardSelection.splice(this.boardSelection.indexOf(row.item.id), 1);
      this.boardPrices -= row.item.price
      this.getTotalPrice();
      }
    },
    // calculates the number of weeks covered by the booking
    getFactor: function() {  
      this.ddate = new Date(this.startDate);
      this.ddate2 = new Date(this.endDate);
      this.dateDiff = Math.floor(this.ddate2.getTime() - this.ddate.getTime());
      this.factor = Math.ceil((this.dateDiff/(1000 * 60 * 60 * 24))/7);
    },
    // multiplies the factor by the array containing the selected boards' base prices to get the total price
    getPrice: function() {  
      this.totalPrice = (parseInt(this.boardPrices) * parseInt(this.factor));
    },
    // recalculates the total price after any changes to selection or the dates
    getTotalPrice: function() {  
      this.getFactor();
      this.getPrice();
      console.log('tp changed')
    },
    logOut: function() {  
      // Axios.get('http://localhost:8081/logout')
      location.href = 'http://localhost:8081/logout'

    },
    // gathers all the neccessary data and sends it in an axios post in order for an SQL querry to be initiated
    makeSelection() {
        this.totalBoards = this.boardSelection.length;
        const params = { 
            startDate: this.startDate, endDate: this.endDate, campaignName: this.campaignName,
            boardSelection: this.boardSelection, totalBoards: this.totalBoards, totalPrice: this.totalPrice,
            user: this.currentUser
            };
        Axios.post('http://localhost:8081/api/bookingCreate', JSON.stringify(params),
            {
            headers: {
              'Content-Type': 'application/json'
              }
            })
          .then(response=>{
            console.log(response)
        location.href = 'http://localhost:8080/#/home'
      })
    },
  },
  // fetches the board data from the database, and sets the default start and end date(today and a week from now respectively)
  beforeMount(){
    this.startDate = this.date
    this.endDate = this.date2
    Axios.get('http://localhost:8081/boards')
      .then(response=>{
        this.boards = response.data
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