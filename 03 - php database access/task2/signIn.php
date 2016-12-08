<div class="signIn">
  <center class="action_title"> SignIn </center>
  <div>
    <form name="signInForm" action="index.php" method="post">
      <table align='center' style="position:relative; margin-left: 12px">
        <tr>
          <td><label>Benutzername </label></td>
          <td><label>: </label></td>
          <td class="inputs_content">
            <div class="fa fa-user inputs_icon"></div>
            <input name="user_name" class="inputs" type="text"  required/>
          </td>
        </tr>
        <tr>
          <td><label>Passwort </label></td>
          <td><label>: </label></td>
          <td class="inputs_content">
            <div class="fa fa-key inputs_icon"></div>
            <input name="psw_login" class="inputs" type="password"  required/>
          </td>
        </tr>
        <tr>
          <td><label>Vorname </label></td>
          <td><label>: </label></td>
          <td class="inputs_content">
            <div class="fa  fa-user-circle inputs_icon"></div>
            <input name="first_name" class="inputs" type="text"  required/>
          </td>
        </tr>
        <tr>
          <td><label>Nachname </label></td>
          <td><label>: </label></td>
          <td class="inputs_content">
            <div class="fa  fa-user-circle inputs_icon"></div>
            <input name="second_name" class="inputs" type="text"  required/>
          </td>
        </tr>
        <tr>
          <td><label>Anrede </label></td>
          <td><label>: </label></td>
          <td class="inputs_content">
            <div class="fa"></div>
            <select name="salutation" style='width: 100%; height:25px'>
              <option selected="true">Herr</option>
              <option>Frau</option>
            </select>
          </td>
        </tr>
        <tr>
          <td><label>Geburtsdatum </label></td>
          <td><label>: </label></td>
          <td class="inputs_content">
            <div class="fa fa-calendar inputs_icon"></div>
            <input name="date_of_birth" class="inputs" type="date"/>
          </td>
        </tr>
        <tr>
          <td><label>Email </label></td>
          <td><label>: </label></td>
          <td class="inputs_content">
            <div class="fa fa-at inputs_icon"></div>
            <input name="user_mail" class="inputs" type="email"  required/>
          </td>
        </tr>
        <tr>
          <td><label>Anschrift </label></td>
          <td><label>: </label></td>
          <td class="inputs_content">
            <div class="fa fa-map-marker inputs_icon"></div>
            <input name="user_address" class="inputs" type="text" />
          </td>
        </tr>
        <tr>
          <td><label>Tel </label></td>
          <td><label>: </label></td>
          <td class="inputs_content">
            <div class="fa fa-phone inputs_icon"></div>
            <input name="user_tel" class="inputs" type="text"/>
          </td>
        </tr>
        <tr>
          <td colspan="3">

              <button class="fa-sign-in buttons" name="new_account">New Account</button>
        
          </td>
        </tr>
      </table>
    </form>
  </div>
