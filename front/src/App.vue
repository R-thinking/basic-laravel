<script>
import { ref, computed } from "vue";
import axios from "axios";
/* axios.defaults.withCredentials = true;
axios.defaults.baseURL = "/api"; */
export default {
    setup() {
        const getData = async () => {
            await axios.get("/api/posts").then((res) => console.log(res));
        };
        const updateData = async () => {
            // await axios.get("/api/posts").then((res) => console.log(res));
        };
        const deleteData = async () => {
            // await axios.get("/api/posts").then((res) => console.log(res));
        };

        return { getData, updateData, deleteData };
    },
    async created() {},
};
</script>

<template>
    <div id="main">
        <h1>Main Page</h1>
        <div class="menuList">
            <button @click="getData">Get Data</button>
            <button @click="updateData">Updata Data</button>
            <button @click="deleteData">Delete Data</button>
        </div>
    </div>
</template>

<style></style>
