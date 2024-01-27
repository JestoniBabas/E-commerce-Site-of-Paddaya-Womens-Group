import React from "react";
import ReactDOM from "react-dom";

function Login() {
    return(
        <div className="login">
            <center><span class="glyphicon glyphicon-home text-primary fire_i" aria-hidden="true"></span></center>
            <h4 class="text-center">Hotel Management System</h4>
            <br/>
            <form method="POST" action="server.php">
                <label>Enter email</label>
                <input type="email" name="email" className="form-control email" autofocus required /><br/>
                <label>Your Password</label>
                <input type="password" name="pwd" className="form-control pwd" required /><br/>
                <input type="submit" name="btn_login" className="btn btn-success btn_login" value="LOG IN"/>
                <br/><br/> <p className="text-secondary p_forgot">Forgotten password? Please contact your system administrator</p>
            </form>
        </div>
    )
}

ReactDOM.render(
    <div>
        <Login />
    </div>,
    document.querySelector('#root')
)