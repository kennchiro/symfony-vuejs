<template>
<div>
  <mdb-edge-header color="teal darken-2">
    <div class="category-page-background"> </div>
  </mdb-edge-header>

  <bird-container>

    <h2 class="pb-4">
      <mdb-icon far icon="newspaper" color="red"/>
      <strong>Category</strong>
      <div style="display: flex;float: right">
        <!--          <mdb-btn @click="goTo('/acceuil')" color="default"> Acceuil</mdb-btn>-->
        <mdb-btn @click="add" color="secondary"> Add </mdb-btn>
      </div>
    </h2>

    <section>
      <el-table
          :data="categorys"
          style="width: 100%;margin-bottom: 20px;"
          row-key="id"
          ref="categoryTable"
          border
          default-expand-all
          highlight-current-row
          :row-class-name="tableRowClassName"
          :row-style="tableRowStyle">
        <el-table-column
            prop="nomcat"
            label="Category name">
        </el-table-column>

        <el-table-column
            fixed="right"
            label="Action"
            width="120">
          <template slot-scope="scope">
            <el-button @click.native.prevent="edit(scope.$index, categorys)"
                       type="primary"
                       data-toggle="modal"
                       data-target="#modalCenterTable"
                       size="small"
                       icon="el-icon-edit"
                       circle>
            </el-button>
            <el-button @click.native.prevent="remove(scope.$index, categorys)"
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

     <form-category v-if="dialogFormVisible" ref="category" @dialog="dialog($event)"/>

      <span slot="footer" class="dialog-footer">
                    <el-button @click="cancel">Cancel</el-button>
                    <el-button type="primary" @click="validate"> Validate </el-button>
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
import FormCategory from "./components/FormCategory";
import BirdContainer from "../../components/BirdContainer";
import {
  mdbIcon,
  mdbEdgeHeader,
  mdbBtn,
} from 'mdbvue';

import {mapState, mapActions, mapMutations} from 'vuex';

export default {
name: "index",
  components: {
  FormCategory,  BirdContainer,
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
    this.allCategoryAction({page: 1})
  },

  computed:{
    // thread
    ...mapState({
      categorys: (state) => state.category.categorys, //
      total: (state) => state.category.total,
      maxPagination: (state) => state.category.maxPagination
    })
  },

  methods:{
    ...mapActions('category',['allCategoryAction','removeCategoryAction']),
    ...mapMutations('category',['setCategory','setIsAdd']),

    goTo(path){
      this.$router.push({path: path})
    },

    //
    async handleCurrentChange(page) {
      await this.allCategoryAction({page: page})
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
      this.setCategory(null)
      this.setIsAdd(true)
      this.title = 'Add Category'
      this.dialogFormVisible = true
    },
    edit(index, categorys){
      this.setCategory(categorys[index])
      this.setIsAdd(false)
      this.title = 'Edit Category'
      this.dialogFormVisible = true
    },
    remove(index, categorys){
      this.$confirm('Do you want to delete this line ?', 'Deletion', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning'
      }).then(() => {
        this.removeCategoryAction({id: categorys[index].id})
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
      this.$refs.category.saveCategory()
    },
    dialog(value){
      this.dialogFormVisible = value
    },
    cancel(){
      this.setCategory(null)
      this.dialogFormVisible = false
    }
  }


}
</script>

<style scoped>

</style>