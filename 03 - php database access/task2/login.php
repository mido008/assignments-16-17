<div class="login">
  <center class="action_title" > Login </center>
  <div style="position: relative; margin-top: 20%;">
    <form name="loginForm" action="index.php" method="post">
      <table style="position:relative; width: 100%;" align="center">
        <tr>
          <td><label>Benutzername </label></td>
          <td><label>: </label></td>
          <td class="inputs_content">
            <div class="fa fa-user inputs_icon"></div>
            <input name="user_name_login"  type="text" class="inputs" required/>
          </td>
        </tr>
        <tr>
          <td><label>Passwort </label></td>
          <td><label>: </label></td>
          <td class="inputs_content">
            <div class="fa fa-key inputs_icon"></div>
            <input name="psw_login" type="password" class="inputs" required/>
          </td>
        </tr>
        <tr>
          <td colspan="3">
            <label style="color: rot; display: <?= $show_login_error;?>">
              Login nicht möglich : Benutzername oder Passwort ist falsh
            </label>
          </td>
        </tr>
        <tr>
          <td colspan="3">

              <button class="fa-sign-in buttons" name="login_account"> Login </button>

            </td>
        </tr>
      </table>
    </form>
  </div>
</div>
