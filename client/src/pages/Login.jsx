import { useState } from "react";
import Input from "../components/others/Input";
import { Link } from "react-router-dom";
import Button from "../components/others/Button";
import { useNavigate } from "react-router-dom";
import axios from "axios";

let protocol = "http://";
let host = "127.0.0.1:8000";
let path = "/api/v1/guest/login";

const url = protocol + host + path;

const Login = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const navigate = useNavigate();

  const handleLogin = async (e) => {
    e.preventDefault();

    // const form = new FormData();

    // form.append("email", email);
    // form.append("password", password);

    try {
      const response = await axios.post(
        url,
        {
          email,
          password: password,
        },
        {
          headers: {
            Accept: "application/json",
          },
        }
      );
      if (response.data.success == true) {
        localStorage.setItem("id", response.data.user.id);
        localStorage.setItem("full_name", response.data.user.full_name);
        localStorage.setItem("token", response.data.user.token);

        navigate("/Home");
      } else {
        console.log("Login failed:", response.data.message);
      }
    } catch (error) {
      console.error("Error during login:", error);
    }
  };

  return (
    <section className="container login_signup_section">
      <form className="bg-primary body2">
        <h2 className="text-white h2">Login</h2>
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
          name={"password"}
          value={password}
          onChange={(e) => setPassword(e.target.value)}
          placeholder={"Password"}
          classes={"body1"}
        />
        <Button
          text={"Login up"}
          onClick={handleLogin}
          classes={"bg-secondary text-black w-full"}
        />
        <p className="body2 text-white">
          Have an account ?{" "}
          <span className="text-secondary">
            <Link to={"/signup"}>Sign Up</Link>
          </span>
        </p>
      </form>
    </section>
  );
};
export default Login;
