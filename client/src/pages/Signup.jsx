import { useState } from "react";
import Input from "../components/others/Input";
import { Link } from "react-router-dom";
import Button from "../components/others/Button";
import { useNavigate } from "react-router-dom";
import axios from "axios";

let protocol = "http://";
let host = "127.0.0.1:8000";
let path = "/api/v1/guest/signup";

const url = protocol + host + path;

const Signup = () => {
  const [fullName, setfullName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const navigate = useNavigate();

  const handleSignup = async (e) => {
    e.preventDefault();
    if (!validate_password(password)) {
      alert(
        "Your Password should contain letters, numbers and should contain more than 7 characters"
      );
      return;
    }

    try {
      const response = await axios.post(
        url,
        {
          full_name: fullName,
          email,
          password: password,
        },
        {
          headers: {
            Accept: "application/json",
          },
        }
      );
      if (response.data.success) {
        localStorage.setItem("id", response.data.user.id);
        localStorage.setItem("full_name", response.data.user.full_name);
        localStorage.setItem("token", response.data.user.token);
        navigate("/Home");
      } else {
        console.log("Signup failed:", response.data.message);
      }
    } catch (error) {
      console.error("Error during signup:", error);
    }
  };

  function validate_password(pass) {
    let contains_nb = false;
    let contains_letter = false;
    if (pass.length < 8) {
      return false;
    }

    for (let i = 0; i < pass.length; i++) {
      if ("1234567890".includes(pass[i])) {
        contains_nb = true;
      } else if (
        "QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm".includes(pass[i])
      ) {
        contains_letter = true;
      }
    }

    return contains_nb && contains_letter;
  }

  return (
    <section className="container login_signup_section">
      <form className="bg-primary body2">
        <h2 className="text-white h2">Sign Up</h2>
        <Input
          type={"text"}
          name={"full_name"}
          value={fullName}
          onChange={(e) => setfullName(e.target.value)}
          placeholder={"Full Name"}
          classes={"body1"}
        />
        <Input
          type={"email"}
          name={"email"}
          value={email}
          onChange={(e) => setEmail(e.target.value)}
          placeholder={"Email"}
          classes={"body1"}
        />
        <Input
          type={"password"}
          name={"pass"}
          value={password}
          onChange={(e) => setPassword(e.target.value)}
          placeholder={"Password"}
          classes={"body1"}
        />
        <Button
          text={"Sign up"}
          onClick={handleSignup}
          classes={"bg-secondary text-black w-full"}
        />
        <p className="body2 text-white">
          Don't have account ?{" "}
          <span className="text-secondary">
            <Link to={"/login"} value="Login">
              Login
            </Link>
          </span>
        </p>
      </form>
    </section>
  );
};
export default Signup;
