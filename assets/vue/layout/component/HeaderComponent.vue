<template>
    <div>
      <mdb-navbar position="top" dark color="black" scrolling>
        <mdb-navbar-brand href="#"> <mdb-icon fab icon="vuejs" />
          & <mdb-icon fab icon="symfony" /> </mdb-navbar-brand>
        <mdb-navbar-toggler>
          <mdb-navbar-nav>
            <mdb-nav-item @click="goTo('/acceuil')" waves-fixed> Acceuil </mdb-nav-item>
            <mdb-nav-item @click="goTo('/article')" waves-fixed> Article </mdb-nav-item>
            <mdb-nav-item @click="goTo('/category')" waves-fixed> Category </mdb-nav-item>
            <mdb-nav-item @click="goTo('/comment')" waves-fixed> Comment </mdb-nav-item>
            <mdb-nav-item @click="goTo('/author')" waves-fixed> Author </mdb-nav-item>
<!--            <mdb-nav-item @click="goTo('')" waves-fixed> Author/article </mdb-nav-item>-->
            <mdb-dropdown tag="li" class="nav-item">
              <mdb-dropdown-toggle
                  tag="a"
                  navLink
                  color="black"
                  slot="toggle"
                  waves-fixed
              > other </mdb-dropdown-toggle>
              <mdb-dropdown-menu>
                <mdb-dropdown-item>Action</mdb-dropdown-item>
                <mdb-dropdown-item>Something else here</mdb-dropdown-item>
              </mdb-dropdown-menu>
            </mdb-dropdown>
          </mdb-navbar-nav>
          <form>
            <mdb-input
                type="text"
                class="text-white"
                placeholder="Search"
                aria-label="Search"
                label
                navInput
                waves
                waves-fixed
            />
          </form>
        </mdb-navbar-toggler>
      </mdb-navbar>
    </div>
</template>

<script>
    import {
      mdbNavbar,
      mdbNavItem,
      mdbNavbarNav,
      mdbNavbarToggler,
      mdbDropdown,
      mdbDropdownItem,
      mdbDropdownMenu,
      mdbDropdownToggle,
      mdbInput,
      mdbNavbarBrand,
        mdbIcon
    } from "mdbvue";
    export default {
        name: "HeaderComponent",
        components: {
          mdbNavbar,
          mdbNavItem,
          mdbNavbarNav,
          mdbNavbarToggler,
          mdbDropdown,
          mdbDropdownItem,
          mdbDropdownMenu,
          mdbDropdownToggle,
          mdbInput,
          mdbNavbarBrand,
          mdbIcon
        },

      methods:{
        goTo(path){
          this.$router.push({path: path});
        }
      }

    }
</script>

<style scoped>

.navbar .dropdown-menu a:hover {
  color: inherit !important;
}
</style>