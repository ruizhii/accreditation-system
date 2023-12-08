import {Link} from "react-router-dom";
import {createRef, useState} from "react";
import axiosClient from "../axios-client.js";
import {useStateContext} from "../contexts/ContextProvider.jsx";

export default function Login() {
    const emailRef = createRef();
    const passwordRef = createRef();
    const {setUser, setToken} = useStateContext()   // Variable comes from ContextProvider.jsx : StateContext
    const [message, setMessage] = useState(null);

    const onSubmit = (ev) => {
        ev.preventDefault()

        const payload = {
            email: emailRef.current.value,
            password: passwordRef.current.value,
          }
          axiosClient.post('/login', payload)
            .then(({data}) => {
              setUser(data.user)  // Auto redirect user to user page
              setToken(data.token)
            })
            .catch(err => {
              const response = err.response;
              if (response && response.status === 422) {
                  setMessage(response.data.message)
              }
            })
    }

    return (
        <div className="login-signup-form animated fadeInDown">
      <div className="form">
        <form onSubmit={onSubmit}>
          <h1 className="Title">Login into your account</h1>

          {message &&
            <div className="alert">
              <p>{message}</p>
          </div>
          }

          <input ref={emailRef} type="email" placeholder="Email"/>
          <input ref={passwordRef} type="password" placeholder="Password"/>
          <button className="btn btn-block">Login</button>
          <p className="message">Not Registered? <Link to="/signup">Create an account</Link></p>
        </form>
      </div>
    </div>
    )
}