<template>
  <div>
    <mdb-edge-header color="teal darken-2">
      <div class="category-page-background"> </div>
    </mdb-edge-header>

    <bird-container>

      <h2 class="pb-4">
        <mdb-icon far icon="newspaper" color="red"/>
        <strong>Car</strong>
        <div style="display: flex;float: right">
<!--          <mdb-btn @click="goTo('/acceuil')" color="default"> Acceuil</mdb-btn>-->
          <mdb-btn @click="add" color="secondary">Add Car</mdb-btn>
        </div>
      </h2>

      <section>
        <el-table
            :data="cars"
            style="width: 100%;margin-bottom: 20px;"
            row-key="id"
            ref="carTable"
            border
            default-expand-all
            highlight-current-row
            :row-class-name="tableRowClassName"
            :row-style="tableRowStyle">
          <el-table-column
              prop="name"
              label="Name">
          </el-table-column>
          <el-table-column
              prop="type"
              label="Type of car">
          </el-table-column>
          <el-table-column
              fixed="right"
              label="Action"
              width="120">
            <template slot-scope="scope">
              <el-button @click.native.prevent="edit(scope.$index, cars)"
                         type="primary"
                         data-toggle="modal"
                         data-target="#modalCenterTable"
                         size="small"
                         icon="el-icon-edit"
                         circle>
              </el-button>
              <el-button @click.native.prevent="remove(scope.$index, cars)"
                         type="danger"
                         size="small"
                         icon="el-icon-delete"
                         circle>
              </el-button>
            </template>
          </el-table-column>
        </el-table>
      </section>

      <el-dialog :title="title" :visible.sync="dialogFormVisible">

        <form-car v-if="dialogFormVisible" ref="car" @dialog="dialog($event)"/>

        <span slot="footer" class="dialog-footer">
                    <el-button @click="cancel">Cancel</el-button>
                    <el-button type="primary" @click="validate">Validate</el-button>
                </span>
      </el-dialog>


      <div class="block">
        <el-pagination
            background
            @size-change="handleSizeChange"
            @current-change="handleCurrentChange"
            :current-page.sync="activeIndex"
            :page-size="maxPagination"
            layout="total, prev, pager, next"
            :total="total">
        </el-pagination>
      </div>
    </bird-container>

  </div>
</template>

<script>
import BirdContainer from "../../components/BirdContainer";
import {
  mdbIcon,
  mdbEdgeHeader,
  mdbBtn,
} from 'mdbvue';

import {mapState, mapActions, mapMutations} from 'vuex';
import FormCar from "./components/FormCar";

export default {
  name: "index",
  components: {
    FormCar,
    BirdContainer,
    mdbIcon,
    mdbEdgeHeader,
    mdbBtn,
  },
  data: ()=> {
    return {
      activeIndex: undefined,
      dialogFormVisible: false,
      title: null
    }
  },
  created() {
    this.allCarAction({page: 1})
  },
  computed:{
    // thread
    ...mapState({
      cars: (state) => state.car.cars, //
      total: (state) => state.car.total,
      maxPagination: (state) => state.car.maxPagination
    })
  },
  methods:{
    ...mapActions('car',['allCarAction','removeCarAction']),
    ...mapMutations('car',['setCar','setIsAdd']),
    goTo(path){
      this.$router.push({path: path})
    },

    //
    async handleCurrentChange(page) {
      await this.allCarAction({page: page})
    },

    tableRowClassName({row, rowIndex}) {
      if (row.launch_success === true) {
        return 'success-row';
      } else if (row.launch_success === false) {
        return 'warning-row';
      }
      return 'other-row';
    },
    tableRowStyle({ row, rowIndex }) {
      // return 'background-color: pink'
    },
    handleSizeChange(val) {
      console.log(`${val} items per page`);
    },
    add(){
      this.setCar(null)
      this.setIsAdd(true)
      this.title = 'Add Car'
      this.dialogFormVisible = true
    },
    edit(index, cars){
      this.setCar(cars[index])
      this.setIsAdd(false)
      this.title = 'Edit Car'
      this.dialogFormVisible = true
    },
    remove(index, cars){
      this.$confirm('Do you want to delete this line ?', 'Deletion', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning'
      }).then(() => {
        this.removeCarAction({id: cars[index].id})
        this.$message({
          type: 'success',
          message: 'Deletion completed'
        });
      }).catch(() => {
        this.$message({
          type: 'info',
          message: 'Deletion canceled'
        });
      });
    },
    validate(){
      this.$refs.car.saveCar()
    },
    dialog(value){
      this.dialogFormVisible = value
    },
    cancel(){
      this.setCar(null)
      this.dialogFormVisible = false
    }
  }
}
</script>

<style lang="scss" scoped>

</style>