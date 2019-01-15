<template>
    <v-container fluid grid-list-md>
        <v-snackbar
            v-model="snackbar"
            left
            :color="color"
        >
            {{ response }}
        </v-snackbar>
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
                        <v-form
                            ref="form"
                            v-model="rules.valid"
                        >
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
                                        :rules="rules.name"
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
                                        :rules="rules.name"
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
                                        :rules="rules.email"
                                        required
                                    ></v-text-field>
                                </v-flex>
                                <!--Salary-->
                                <v-flex
                                    xs12
                                    md6
                                >

                                    <v-text-field
                                        type="number"
                                        v-model="employee.salary"
                                        label="Salary"
                                        :rules="rules.salary"
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
                                        :rules="rules.select"
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
                                        :rules="rules.multiSelect"
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
                        </v-form>
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
                rules: {
                    valid: true,
                    name: [
                        v => !!v || 'Name is required',
                        v => (v && v.length <= 10) || 'Name must be less than 10 characters'
                    ],
                    email: [
                        v => !!v || 'E-mail is required',
                        v => /.+@.+/.test(v) || 'E-mail must be valid'
                    ],
                    salary: [
                        v => !!v || 'Salary is required',
                        v => (v && v.length > 2) || 'Salary must be valid more then 100$'
                    ],
                    select: [v => !!v || 'Item is required'],
                    multiSelect: [v => this.employee.staffPositions.length != 0 || 'Item is required'],
                },
                departments: [],
                staffPositions: [],
                snackbar: false,
                response: '',
                color: 'success'
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
            validate () {
                if (this.$refs.form.validate()) {
                    this.snackbar = true
                }
            },
            reset () {
                this.$refs.form.reset()
            },
            resetValidation () {
                this.$refs.form.resetValidation()
            },
            storeEmployee(){
                this.validate()
                if(this.rules.valid === true)
                    axios.post('/api/employees', this.employee)
                        .then(res => {
                            if(res.status === 201){
                                this.color = 'success'
                                this.snackbar = true
                                this.response = 'Employee was be created'
                                this.reset()
                                this.resetValidation()
                            }
                        })
                        .catch(err => {
                            this.color = 'error'
                            if(err.response.status === 422){
                                this.snackbar = true
                                this.response = err.response.data.message
                            }
                            if(err.response.status === 500){
                                this.snackbar = true
                                this.response = 'Server error'
                            }
                        })
            }
        }
    }
</script>