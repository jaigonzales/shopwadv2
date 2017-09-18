<template>
<div>

    <!-- Firstname -->
    <div class="settings_item">
        <span class="s_label">First name</span>
        <span v-if="!isEditingFname">
            <strong>{{ userInfo['firstname'] }}</strong>
                <button id="editFirstName" class="plainButton pull-right" @click.prevent="onEditFirstname">
                    <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                </button>
            </span>
        <span v-else>
                <form method="post" enctype="multipart/form-data" class="form-horizontal" role="form" @submit.prevent="onSaveFname">
                <div class="form-group">
                    <p  :class="{ 'control': true }">
                <input type="text"
                       name="fname"
                       class="form-control"
                       v-model="user_fname"
                       data-vv-as="first name"
                       v-validate="'required|alpha_spaces'"
                       :class="{'input': true, 'has-error': errors.has('fname') }"
                />
                <div v-show="errors.has('fname')" class="msg-error">{{ errors.first('fname') }}</div>
            </p>
                </div>
                <p class="pull-right">
                    <button type="submit" class="btn btn-primary btn-xs" :class="{ 'input': true, 'disabled': errors.has('fname') }">Save</button>
                    <button class="btn btn-default btn-xs" @click.prevent="onCancelEditingFname">Cancel</button>
                </p>
                </form>
            </span>
    </div>
    <!-- Lastname -->
    <div class="settings_item">
        <span class="s_label">Last name</span>
        <span v-if="!isEditingLname">
            <strong>{{ userInfo['lastname'] }}</strong>
            <button id="editLastName"  class="plainButton pull-right" @click.prevent="onEditLastname">
                <i class="fa fa-pencil" aria-hidden="true"></i> Edit
            </button>
            </span>
        <span v-else>
                <form method="post" enctype="multipart/form-data" @submit.prevent="onSaveLname" class="form-horizontal" role="form">
                <div class="form-group">
                <input type="text"
                       name="lname"
                       data-vv-as="last name"
                       v-model="user_lname"
                       class="form-control"
                       v-validate="'required|alpha_spaces'"
                       :class="{'input': true, 'has-error': errors.has('lname') }"
                />
                <div v-show="errors.has('lname')" class="msg-error">{{ errors.first('lname') }}</div>
                </div>
                <p class="pull-right">
                    <button type="submit" class="btn btn-primary btn-xs">Save</button>
                    <button class="btn btn-default btn-xs" @click.prevent="onCancelEditingLname">Cancel</button>
                </p>
            </form>
            </span>
    </div>
    <!-- Birthdate -->
    <div class="settings_item">
        <span class="s_label">Birthday</span>
        <span v-if="!isEditingBday">
            <span v-if="( userInfo['birthday'] ==='' || userInfo['birthday'] == null || userInfo['birthday'] === undefined )">
                <em style="color: #a94442; font-size: 12px">Not set</em>
            </span>
        <span v-else>
                <strong><span v-text="userInfo['birthday']"></span></strong>
            </span>
        <button id="editBirthDate" class="plainButton pull-right" @click.prevent="onEditBday">
                <i class="fa fa-pencil" aria-hidden="true"></i> Edit
            </button>
        </span>
        <span v-else>
                <form method="post" enctype="multipart/form-data" @submit.prevent="onSaveBday" class="form-horizontal" role="form">
                <div class="form-group" style="text-align: center">
                    <div class="controls form-inline">
                        <select name="dob-month" v-model="dob_month" id="dob-month" class="form-control" required>
                            <option disabled value="">Month</option>
                            <option disabled value="">-----</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        <select name="dob-day" v-model="dob_day" id="dob-day" class="form-control" required>
                            <option disabled value="">Day</option>
                            <option disabled value="">---</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                        <select name="dob-year" v-model="dob_year" id="dob-year" class="form-control" required>
                            <option disabled value="">Year</option>
                            <option disabled value="">----</option>
                            <option value="2012">2017</option>
                            <option value="2011">2016</option>
                            <option value="2010">2015</option>
                            <option value="2009">2014</option>
                            <option value="2008">2013</option>
                            <option value="2012">2012</option>
                            <option value="2011">2011</option>
                            <option value="2010">2010</option>
                            <option value="2009">2009</option>
                            <option value="2008">2008</option>
                            <option value="2007">2007</option>
                            <option value="2006">2006</option>
                            <option value="2005">2005</option>
                            <option value="2004">2004</option>
                            <option value="2003">2003</option>
                            <option value="2002">2002</option>
                            <option value="2001">2001</option>
                            <option value="2000">2000</option>
                            <option value="1999">1999</option>
                            <option value="1998">1998</option>
                            <option value="1997">1997</option>
                            <option value="1996">1996</option>
                            <option value="1995">1995</option>
                            <option value="1994">1994</option>
                            <option value="1993">1993</option>
                            <option value="1992">1992</option>
                            <option value="1991">1991</option>
                            <option value="1990">1990</option>
                            <option value="1989">1989</option>
                            <option value="1988">1988</option>
                            <option value="1987">1987</option>
                            <option value="1986">1986</option>
                            <option value="1985">1985</option>
                            <option value="1984">1984</option>
                            <option value="1983">1983</option>
                            <option value="1982">1982</option>
                            <option value="1981">1981</option>
                            <option value="1980">1980</option>
                            <option value="1979">1979</option>
                            <option value="1978">1978</option>
                            <option value="1977">1977</option>
                            <option value="1976">1976</option>
                            <option value="1975">1975</option>
                            <option value="1974">1974</option>
                            <option value="1973">1973</option>
                            <option value="1972">1972</option>
                            <option value="1971">1971</option>
                            <option value="1970">1970</option>
                            <option value="1969">1969</option>
                            <option value="1968">1968</option>
                            <option value="1967">1967</option>
                            <option value="1966">1966</option>
                            <option value="1965">1965</option>
                            <option value="1964">1964</option>
                            <option value="1963">1963</option>
                            <option value="1962">1962</option>
                            <option value="1961">1961</option>
                            <option value="1960">1960</option>
                            <option value="1959">1959</option>
                            <option value="1958">1958</option>
                            <option value="1957">1957</option>
                            <option value="1956">1956</option>
                            <option value="1955">1955</option>
                            <option value="1954">1954</option>
                            <option value="1953">1953</option>
                            <option value="1952">1952</option>
                            <option value="1951">1951</option>
                            <option value="1950">1950</option>
                            <option value="1949">1949</option>
                            <option value="1948">1948</option>
                            <option value="1947">1947</option>
                            <option value="1946">1946</option>
                            <option value="1945">1945</option>
                            <option value="1944">1944</option>
                            <option value="1943">1943</option>
                            <option value="1942">1942</option>
                            <option value="1941">1941</option>
                            <option value="1940">1940</option>
                            <option value="1939">1939</option>
                            <option value="1938">1938</option>
                            <option value="1937">1937</option>
                            <option value="1936">1936</option>
                            <option value="1935">1935</option>
                            <option value="1934">1934</option>
                            <option value="1933">1933</option>
                            <option value="1932">1932</option>
                            <option value="1931">1931</option>
                            <option value="1930">1930</option>
                            <option value="1929">1929</option>
                            <option value="1928">1928</option>
                            <option value="1927">1927</option>
                            <option value="1926">1926</option>
                            <option value="1925">1925</option>
                            <option value="1924">1924</option>
                            <option value="1923">1923</option>
                            <option value="1922">1922</option>
                            <option value="1921">1921</option>
                            <option value="1920">1920</option>
                            <option value="1919">1919</option>
                            <option value="1918">1918</option>
                            <option value="1917">1917</option>
                            <option value="1916">1916</option>
                            <option value="1915">1915</option>
                            <option value="1914">1914</option>
                            <option value="1913">1913</option>
                            <option value="1912">1912</option>
                            <option value="1911">1911</option>
                            <option value="1910">1910</option>
                            <option value="1909">1909</option>
                            <option value="1908">1908</option>
                            <option value="1907">1907</option>
                            <option value="1906">1906</option>
                            <option value="1905">1905</option>
                        </select>
                    </div>
                </div>
                <p class="text-center">
                    <button type="submit" class="btn btn-primary btn-xs">Save</button>
                    <button class="btn btn-default btn-xs" @click.prevent="onCancelEditingBday">Cancel</button>
                </p>
            </form>
            </span>
    </div>
    <!-- Password -->
    <div class="settings_item">
        <span class="s_label">Password</span>
        <span v-if="!isEditingPword" >
            <span v-if="userInfo['provider'] == 'email'">Change Password</span>
            <span v-else>Edit Disabled <span data-toggle="popover" title="" data-content="This account is connected with Facebook." class="label label-info" data-original-title="Edit Disabled">?</span></span>

        <button id="editPassword" class="plainButton pull-right" @click.prevent="onEditPword" v-if="userInfo['provider'] == 'email'" >
                <i class="fa fa-pencil" aria-hidden="true"></i> Edit
            </button>
        </span>
        <span v-else>
                <form method="post" enctype="multipart/form-data" @submit.prevent="onSavePword" class="form-horizontal" role="form" v-if="userInfo['provider'] == 'email'">
                <div class="form-group">
                    <label class="s_label">Existing Password </label>
                    <input type="password" name="existing_password" value="" v-model="existing_password" class="form-control" v-validate="'required'"/>
                    <div class="msg-error" v-if="e_password_error">
                        Current Password did not match. Please try again.
                    </div>
                    <div class="msg-error" v-if="errors.has('existing_password')">
                        Please enter your current password.
                    </div>
                </div>
                <div class="form-group">
                    <label class="s_label">New Password </label>
                    <input type="password" name="new_password" v-model="new_password" value="" class="form-control" v-validate="'required'"/>
                </div>
                <div class="form-group">
                    <label class="s_label">Re-type New Password </label>
                    <input type="password" name="confirm_password" value="" class="form-control" v-validate="'required|confirmed:new_password'"/>
                </div>
                <div class="msg-error" v-show="errors.any()">
                    <div v-if="errors.has('new_password')">
                        New password is required.
                    </div>
                    <div v-if="errors.has('confirm_password')">
                        New password did not match. Please try again.
                    </div>

                </div>
                <p class="pull-right">
                    <button type="submit" class="btn btn-primary btn-xs">Save</button>
                    <button class="btn btn-default btn-xs" @click.prevent="onCancelEditingPword">Cancel</button>
                </p>
                </form>
            </span>
    </div>
    <!-- Email -->
    <div class="settings_item">
        <span class="s_label">Change e-mail</span>
        <span v-if="!isEditingEmail">
            <span v-if="userInfo['provider'] == 'email'"><strong>{{ userInfo['email'] }}</strong></span>
            <span v-else>Edit disabled <span data-toggle="popover" title="" data-content="This account is connected with Facebook." class="label label-info" data-original-title="Edit Disabled">?</span></span>
        <button id="editEmail" class="plainButton pull-right" @click.prevent="onEditEmail" v-if="userInfo['provider'] == 'email'">
                <i class="fa fa-pencil" aria-hidden="true"></i> Edit
            </button>
        </span>
        <span v-else>
                <form method="post" enctype="multipart/form-data" v-on:submit.prevent="onSaveEmail" class="form-horizontal" role="form" v-if="userInfo['provider'] == 'email'">
                <div class="form-group">
                <input type="email"
                       class="form-control"
                       name="email"
                       data-vv-as="email"
                       v-model="user_email"
                       v-validate="'required|email'"
                />
                </div>

                    <div class="msg-error" v-if="emailExists">
                        Email already exists.
                    </div>
                    <div class="msg-error" v-if="errors.has('email')">
                        Please enter a valid email.
                    </div>
                <p class="pull-right">
                    <button type="submit" class="btn btn-primary btn-xs">Save</button>
                    <button class="btn btn-default btn-xs" @click.prevent="onCancelEditingEmail">Cancel</button>
                </p>
            </form>
            </span>
    </div>
</div>
</template>
<script>
import axios from 'axios';
import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);

export default {
    props: ['user'],
    data() {
        return {
            isEditingAvatar: false,
            isEditingFname: false,
            isEditingLname: false,
            isEditingBday: false,
            isEditingEmail: false,
            isEditingPword: false,
            fnameError: false,
            lnameError: false,
            bdayError: false,
            emailError: false,
            pwordError: false,
            e_password_error: false,
            emailExists: false,
            existing_password: '',
            new_password: '',
            dob_month: '',
            dob_day: '',
            dob_year: '',
            attemptDelete: false,
            pword_incorrect: false,
            user_password: '',
            userInfo: []
        }
    },
    mounted: function() {
        this.getUserDetails();
    },
    methods: {
        getUserDetails: function() {
            var monthNames = ["January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ];

            axios.get('/api/v1/user/' + this.user)
                .then(
                    (response) => {
                        this.userInfo = response.data.user;

                        if (this.userInfo['birthday']) {

                            var dob = Date.parse(this.userInfo['birthday']);

                            this.userInfo['birthday'] = dob.getMonthName() + ' ' + dob.getDate() + ', ' + dob.getFullYear();

                            if (dob.getMonth() <= 9) {
                                this.dob_month = '0' + (dob.getMonth() + 1);
                            } else {
                                this.dob_month = (dob.getMonth() + 1);
                            }
                            if (dob.getDate() <= 9) {
                                this.dob_day = '0' + dob.getDate();
                            } else {
                                this.dob_day = dob.getDate();
                            }

                            this.dob_year = dob.getFullYear();
                        }
                    }
                ).catch()
        },
        onEditFirstname: function() {
            this.isEditingFname = true;
            this.user_fname = this.userInfo['firstname'];
        },
        onEditLastname: function() {
            this.isEditingLname = true;
            this.user_lname = this.userInfo['lastname'];
        },
        onEditBday: function() {
            this.isEditingBday = true;
            this.user_bday = this.userInfo['birthday'];
        },
        onEditEmail: function() {
            this.isEditingEmail = true;
            this.user_email = this.userInfo['email'];
        },
        onEditPword: function() {
            this.isEditingPword = true;
        },
        onAttemptDelete: function() {
            this.attemptDelete = true;
        },
        onCancelUploadAvatar: function() {
            $("#currentAvatar").attr("src", this.userInfo['avatar']);
        },
        onCancelEditingFname: function() {
            this.isEditingFname = false;
        },
        onCancelEditingLname: function() {
            this.isEditingLname = false;
        },
        onCancelEditingBday: function() {
            this.isEditingBday = false;
        },
        onCancelEditingEmail: function() {
            this.isEditingEmail = false;
        },
        onCancelEditingPword: function() {
            this.isEditingPword = false;
        },
        onCancelDelete: function(){
            this.attemptDelete = false;
        },
        onSaveFname: function() {

            // validate


            this.$validator.validateAll().then(result => {
                if (result) {

                    axios.put('/api/v1/edit/user/fname', {
                        fname: this.user_fname
                    }).then(
                        (response) => {
                            this.getUserDetails();
                            this.isEditingFname = false;
                        }
                    ).catch(
                        (error) => {
                            console.log(error)
                        }
                    );

                }
            });


        },
        onSaveLname: function() {

            this.$validator.validateAll().then(result => {
                if (result) {
                    axios.put('/api/v1/edit/user/lname', {
                        lname: this.user_lname
                    }).then(
                        (response) => {
                            this.getUserDetails();
                            this.isEditingLname = false;
                        }
                    ).catch(
                        (error) => {
                            console.log(error);
                        })
                }
            })

        },
        onSaveBday: function() {

            // validate
            var fullBirthdate;

            fullBirthdate = this.dob_year + '-' + this.dob_month + '-' + this.dob_day;
            axios.put('/api/v1/edit/user/bday', {
                birthday: fullBirthdate
            }).then(
                (response) => {
                    this.getUserDetails();
                    this.isEditingBday = false;
                }
            ).catch(
                (error) => {
                    console.log(error);
                }
            )
        },
        onSaveEmail: function() {
            // validate

            this.$validator.validateAll().then(result => {
                if (result) {
                    axios.put('/api/v1/edit/user/email', {
                        email: this.user_email
                    }).then(
                        (response) => {
                            if (response.data.res === 1) {
                                this.getUserDetails();
                                this.isEditingEmail = false;
                                if (this.emailExists) {
                                    this.emailExists = false;
                                }
                            } else {
                                this.emailExists = true;
                            }
                        }
                    ).catch(
                        (error) => {
                            console.log(error);
                        }
                    );

                }
            });
        },
        onSavePword: function() {
            // validate
            axios.put('/api/v1/edit/user/pword', {
                existing_password: this.existing_password,
                new_password: this.new_password
            }).then(
                (response) => {
                    if (response.data.res === 1) {
                        this.isEditingPword = false;
                        this.existing_password = '';
                        this.new_password = '';
                        if (this.e_password_error) {
                            this.e_password_error = false;
                        }
                    } else {
                        this.e_password_error = true;
                    }
                }
            ).catch(
                (error) => {
                    console.log('error');
                }
            )

        },

        onDeleteAccount: function() {
            axios.post('/api/v1/user/confirmdelete', {
                confirmed_password: this.user_password
            }).then(
                (response) => {
                    var resp = response.data.res;
                    if ( resp === 200 ){
                        this.pword_incorrect = true;
                    }else{
                        swal({
                            title: 'Account Deleted',
                            html: 'We\'re sorry to see you go.<br />Thank you for using Shop Wad App! ',
                            type: 'success'
                        }).then(function(){
                            window.location = "/"
                        });
                    }
                }
            ).catch(
                (error) => {
                    console.log(error);
                }
            )
        },
    }
}
</script>
