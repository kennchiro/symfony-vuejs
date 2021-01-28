<template>
 <div>

  <mdb-edge-header color="teal darken-2">
    <div class="category-page-background"></div>
  </mdb-edge-header>

   <bird-container>

     <h2 class="pb-4">
       <mdb-icon fab icon="css3" class="text-danger mr-2"/>
       <strong> Lists Livre </strong>
        <div style="display: flex;float: right ">
          <mdb-btn @click="goTo('/acceuil')" color="default"> Acceuil </mdb-btn>
          <mdb-btn @click="add" color="secondary"> Add Livre </mdb-btn>
        </div>
     </h2>

     <section>
       <el-table :data="livres"
                 style="width: 100%;margin-bottom: 20px;"
                 row-key="id"
                 ref="livreTable"
                 border
                 default-expand-all
                 highlight-current-row
                 :row-class-name="tableRowClassName"
                 :row-style="tableRowStyle">

         <el-table-column prop="titlelivre" label="Title livre"> </el-table-column>
         <el-table-column prop="edition" label="Edition"> </el-table-column>
         <el-table-column prop="taille" label="Taille"> </el-table-column>

         <!--    Notre boutton et le template de changement de valeur     -->
         <el-table-column fixed="right" label="action" width="120">
          <template slot-scope="scope">

            <el-button @click.native.prevent="edit(scope.$index, livres)"
                       type="primary"
                       data-toggle="modal"
                       data-target="#modalCenterTable"
                       size="small"
                       icon="el-icon-edit"
                       circle>
            </el-button>

            <el-button @click.native.prevent="remove(scope.$index, livres)"
                       type="danger"
                       size="small"
                       icon="el-icon-delete"
                       circle>
            </el-button>


          </template>
         </el-table-column>
       </el-table>
     </section>

     <!--  Modale de formulaire   -->
     <el-dialog :title="title" :visible.sync="dialogFormVisible">

       <el-form :model="formLivre">

          <el-form-item label="Title Livre">
            <el-input v-model="formLivre.titlelivre"></el-input>
          </el-form-item>

         <el-form-item label="Edition">
           <el-input v-model="formLivre.edition"></el-input>
         </el-form-item>

         <el-form-item label="Taille">
           <el-input v-model="formLivre.taille"></el-input>
         </el-form-item>

       </el-form>

       <span slot="footer" class="ve-dialog-footer">
         <el-button @click="dialogFormVisible = false"> Cancel </el-button>
         <el-button @click="validate" type="primary"> validate </el-button>
       </span>

     </el-dialog>

     <div class="block">
       <el-pagination background
                      @size-changed="handleSizeChange"
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
import { mdbIcon, mdbEdgeHeader,mdbBtn } from 'mdbvue';
import {mapState, mapActions, mapMutations} from 'vuex';
import { required } from 'vuelidate/lib/validators'

export default {
  name: "index",

  validations:{
    formLivre: {
      titlelivre:{required},
      edition: {required},
      taille: {required}
    }
  },

  components: {
    mdbIcon, mdbEdgeHeader,mdbBtn,BirdContainer
  },

  data: ()=> {
     return{
       formLivre: {},
       livre: {},

       title: null,
       idAdd: false,
       activeIndex: undefined,
       dialogFormVisible: false
     }
  },

  created() {
    this.allLivreAction({page: 1})
  },

  computed: {
    ...mapState({
        livres: (state) => state.livre.livres,
        total: (state) => state.livre.total,
        maxPagination: (state) => state.livre.maxPagination
    })
  },

   methods: {
     ...mapActions('livre', ['allLivreAction', 'updateLivreAction', 'removeLivreAction']),
     ...mapMutations('livre',['setLivre']),

     // redirect path clic
     goTo(path){
       this.$router.push({path: path})
     },

     // only function clic the button add to open the modal form
     add() {
       this.isAdd = true
       this.formLivre = {}
       this.title = 'add Livre'
       this.dialogFormVisible = true
     },

     // only function clic the button edit to open the modal form edit with data livre
     edit(index, livres) {
       this.idAdd = false
       this.livre = livres[index]
       this.formLivre = livres[index]
       this.title = 'Edit Livre'
       this.dialogFormVisible = true
     },

     remove(index, livres){
       this.$confirm('Do you want to delete this line ?', 'Deletion', {
         confirmButtonText: 'ok',
         cancelButtonClass: 'cancel',
         type: 'warning'
       }).then(() => {
         this.removeLivreAction( {id: livres[index].id} )
         this.$message( {
           type: 'success',
           message:'Deletion canceled'
         });
       }).catch(() => {
         this.$message({
           type:'info',
           message:'Deletion canceled'
         });
       });
     },

     async validate(){
       this.$v.$touch()
       if(this.$v.$invalid){
         this.$notify({
           title:'warning',
           message: 'Mandatory name field',
           type: 'warning'
         });
         return false
       }

       const param = {
         id: this.idAdd ? 0 : this.livre.id,
         titlelivre: this.formLivre.titlelivre,
         edition: this.formLivre.edition,
         taille: this.formLivre.taille
       }

        await this.updateLivreAction(param)
        this.dialogFormVisible = false;

     },

     async handleCurrentChange(page) {
       await this.allLivreAction({page: page})
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

   }


}
</script>

<style scoped>

</style>