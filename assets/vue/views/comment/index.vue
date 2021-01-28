<template>
  <div>
    <mdb-edge-header color="teal darken-2">
      <div class="category-page-background"> </div>
    </mdb-edge-header>

    <bird-container>

      <h2 class="pb-4">
        <mdb-icon far icon="newspaper" color="red"/>
        <strong> Comment of each article </strong>
        <div style="display: flex;float: right">
          <!--                    <mdb-btn @click="goTo('/acceuil')" color="default"> Acceuil</mdb-btn>-->
          <mdb-btn @click="add" color="secondary">Add Comment</mdb-btn>
        </div>
      </h2>

      <section>
        <el-table
            :data="comments"
            style="width: 100%;margin-bottom: 20px;"
            row-key="id"
            ref="commentTable"
            border
            default-expand-all
            highlight-current-row
            :row-class-name="tableRowClassName"
            :row-style="tableRowStyle">
          <el-table-column
              prop="persocom"
              label="Person">
          </el-table-column>
          <el-table-column
              prop="datecom"
              label="Date">
          </el-table-column>
          <el-table-column
              prop="textcom"
              label="Comments">
          </el-table-column>
          <el-table-column
              fixed="right"
              label="Action"
              width="120">
            <template slot-scope="scope">
              <el-button @click.native.prevent="edit(scope.$index, comments)"
                         type="primary"
                         data-toggle="modal"
                         data-target="#modalCenterTable"
                         size="small"
                         icon="el-icon-edit"
                         circle>
              </el-button>
              <el-button @click.native.prevent="remove(scope.$index, comments)"
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

       <form-comment v-if="dialogFormVisible" ref="comment" @dialog="dialog($event)"/>

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
import FormComment from "./components/FormComment";
import BirdContainer from "../../components/BirdContainer";
import {mdbIcon, mdbEdgeHeader, mdbBtn} from 'mdbvue';

import {mapState, mapActions, mapMutations} from 'vuex';

export default {
  name: "index",
  components: {
    FormComment,
    BirdContainer,
    mdbIcon,
    mdbEdgeHeader,
    mdbBtn
  },

  data: ()=> {
    return {
      activeIndex: undefined,
      dialogFormVisible: false,
      title: null
    }
  },

  created() {
    this.allCommentAction({page: 1})
  },

  computed:{
    // thread
    ...mapState({
      comments: (state) => state.comment.comments, // 'article' ici c'est la module->store
      total: (state) => state.comment.total,
      maxPagination: (state) => state.comment.maxPagination
    })
  },

  methods:{
    ...mapActions('comment',['allCommentAction','removeCommentAction']),
    ...mapMutations('comment',['setComment','setIsAdd']),
    goTo(path){
      this.$router.push({path: path})
    },

    //
    async handleCurrentChange(page) {
      await this.allCommentAction({page: page})
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
      this.setComment(null)
      this.setIsAdd(true)
      this.title = 'Add Article'
      this.dialogFormVisible = true
    },
    edit(index, comments){
      this.setComment(comments[index])
      this.setIsAdd(false)
      this.title = 'Edit Comment'
      this.dialogFormVisible = true
    },
    remove(index, comments){
      this.$confirm('Do you want to delete this line ?', 'Deletion', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning'
      }).then(() => {
        this.removeCommentAction({id: comments[index].id})
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
      this.$refs.comment.saveComment()
    },
    dialog(value){
      this.dialogFormVisible = value
    },
    cancel(){
      this.setComment(null)
      this.dialogFormVisible = false
    }
  } //


}
</script>