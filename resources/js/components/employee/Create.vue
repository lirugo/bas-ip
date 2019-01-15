<template>
    <v-container fluid grid-list-md>
        <!--Create employee-->
        <v-layout row wrap>
            <v-flex xs12 md6 offset-md3>
                <v-card>
                    <v-card-text class="pb-0">
                        <h3 class="text-md-center headline">
                                Create Employee
                            </h3>
                    </v-card-text>
                    <v-card-text>
                        <v-layout row wrap>
                            <!--First name-->
                            <v-flex
                                xs12
                                md4
                            >
                                <v-text-field
                                    v-model="employee.firstName"
                                    :counter="10"
                                    label="First name"
                                    required
                                ></v-text-field>
                            </v-flex>
                            <!--Middle name-->
                            <v-flex
                                xs12
                                md4
                            >
                                <v-text-field
                                    v-model="employee.middleName"
                                    :counter="10"
                                    label="Middle name"
                                    required
                                ></v-text-field>
                            </v-flex>
                            <!--Last name-->
                            <v-flex
                                xs12
                                md4
                            >
                                <v-text-field
                                    v-model="employee.lastName"
                                    :counter="10"
                                    label="Last name"
                                    required
                                ></v-text-field>
                            </v-flex>
                        </v-layout>

                        <v-layout row wrap>
                            <!--Email-->
                            <v-flex
                                xs12
                                md6
                            >
                                <v-text-field
                                    v-model="employee.email"
                                    label="Email"
                                    required
                                ></v-text-field>
                            </v-flex>
                            <!--Salary-->
                            <v-flex
                                xs12
                                md6
                            >

                                <v-text-field
                                    v-model="employee.salary"
                                    label="Salary"
                                    required
                                ></v-text-field>
                            </v-flex>
                        </v-layout>

                        <v-layout row wrap>
                            <!--Departments-->
                            <v-flex
                                xs12
                                md6
                            >
                                <v-select
                                    :items="departments"
                                    v-model="employee.department"
                                    item-value="id"
                                    item-text="name"
                                    label="Select Department"
                                ></v-select>
                            </v-flex>
                            <!--Staff Positions-->
                            <v-flex
                                xs12
                                md6
                                d-flex
                            >
                                <v-select
                                    :items="staffPositions"
                                    v-model="employee.staffPositions"
                                    item-value="id"
                                    item-text="name"
                                    multiple
                                    label="Select Staff Positions"
                                ></v-select>
                            </v-flex>
                        </v-layout>

                        <!--Create btn-->
                        <v-btn
                            color="success"
                            @click="storeEmployee()"
                            dark
                            absolute
                            bottom
                            right
                            fab
                        >
                            <v-icon>add</v-icon>
                        </v-btn>
                    </v-card-text>

                </v-card>
            </v-flex>

        </v-layout>
    </v-container>

</template>

<script>
    export default{
        data(){
            return {
                employee: {
                    firstName: '',
                    middleName: '',
                    lastName: '',
                    email: '',
                    department: '',
                    staffPositions: [],
                },
                departments: [],
                staffPositions: [],
            }
        },
        created(){
            //Get departments
            fetch('/api/departments')
                .then(res => res.json())
                .then(json => this.departments = json)
                .catch(err => console.warn(err))
            //Get staff positions
            fetch('/api/staffpositions')
                .then(res => res.json())
                .then(json => this.staffPositions = json)
                .catch(err => console.warn(err))
        },
        methods: {
            storeEmployee(){
                axios.post('/api/employees', this.employee)
                    .then(res => console.log(res))
                    .catch(err => console.warn(err))
            }
        }
    }
</script>