<script>
import { ref, computed } from "vue";
import axios from "axios";
/* axios.defaults.withCredentials = true;
axios.defaults.baseURL = "/api"; */
export default {
    setup() {
        const getData = async () => {
            await axios.get("/api/users").then((res) => console.log(res));
        };

        const createData = async () => {
            await axios
                .post("/api/users", {
                    convertedID: 3,
                    convertedName: "tester3",
                    convertedEmail: "test3@test.com",
                    convertedPassword: "testPassword",
                })
                .then((res) => {
                    console.log(res);
                });
        };

        const updateData = async () => {
            await axios
                .put("/api/users/2", {
                    convertedEmail: "test12@test.com",
                    convertedName: "tester2",
                })
                .then((res) => console.log(res));
        };

        const deleteData = async () => {
            await axios
                .delete("/api/users", {
                    data: { id: 3 },
                })
                .then((res) => console.log(res));
        };

        return { getData, createData, updateData, deleteData };
    },
    async created() {},
};
</script>

<template>
    <div id="main">
        <h1>Main Page</h1>
        <div class="menuList">
            <button @click="getData">Get Data</button>
            <button @click="createData">Create Data</button>
            <button @click="updateData">Update Data</button>
            <button @click="deleteData">Delete Data</button>
        </div>
    </div>
</template>

<style></style>
