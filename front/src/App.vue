<script>
import { ref, computed } from "vue";
import axios from "axios";
/* axios.defaults.withCredentials = true;
axios.defaults.baseURL = "/api"; */
export default {
    setup() {
        let userList = ref([]);
        const getData = async () => {
            await axios.get("/api/users").then((res) => {
                console.log(res);
                const data = res.data.data;
                userList.value = [...data.users];
            });
        };

        const createData = async () => {
            await axios
                .post("/api/users", {
                    user: {
                        convertedID: 3,
                        convertedName: "tester3",
                        convertedEmail: "test3@test.com",
                        convertedPassword: "testPassword",
                    },
                })
                .then((res) => {
                    console.log(res);
                });
        };

        const updateData = async () => {
            await axios
                .put("/api/users/2", {
                    convertedEmail: "test11@test.com",
                    convertedName: "tester2",
                })
                .then((res) => console.log(res));
        };

        const deleteData = async () => {
            await axios
                .delete("/api/users/10", {})
                .then((res) => console.log(res));
        };

        const login = async () => {
            await axios
                .post("/api/auth/login", {
                    email: "tester@test.com",
                    password: "12345678",
                })
                .then((res) => console.log(res));
        };

        return { getData, createData, updateData, deleteData, userList, login };
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
            <button @click="login">Login</button>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>VerifiedAt</th>
                <th>Token</th>
                <th>CreatedAt</th>
                <th>UpdatedAt</th>
            </tr>
            <tr v-for="(user, index) in userList" :key="index">
                <td>{{ user.convertedID }}</td>
                <td>{{ user.convertedName }}</td>
                <td>{{ user.convertedEmail }}</td>
                <td>{{ user.convertedPassword }}</td>
                <td>{{ user.convertedEmailVerifiedAt }}</td>
                <td>{{ user.convertedRememberToken }}</td>
                <td>{{ user.createdAt }}</td>
                <td>{{ user.updatedAt }}</td>
            </tr>
        </table>
    </div>
</template>

<style></style>
