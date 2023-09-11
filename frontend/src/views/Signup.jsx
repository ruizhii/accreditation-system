import {Link} from "react-router-dom";
import {createRef, useState} from "react";
import axiosClient from "../axios-client.js";
import {useStateContext} from "../contexts/ContextProvider.jsx";

export default function Signup() {
  const nameRef = createRef();
  const emailRef = createRef();
  const passwordRef = createRef();
  const passwordConfirmationRef = createRef();
  const {setUser, setToken} = useStateContext()   // Variable comes from ContextProvider.jsx : StateContext
  const [errors, setErrors] = useState(null);

  const onSubmit = (ev) => {
    ev.preventDefault()
    const payload = {
      name: nameRef.current.value,
      email: emailRef.current.value,
      password: passwordRef.current.value,
      password_confirmation: passwordConfirmationRef.current.value,
    }
    axiosClient.post('/signup', payload)
      .then(({data}) => {
        // Auto redirect user to user page
        setUser(data.user)
        setToken(data.token)
      })
      .catch(err => {
        const response = err.response;
        if (response && response.status === 422) {
          setErrors(response.data.errors)
        }
      })
  }

    return (
      <div className="login-signup-form animated fadeInDown">
        <div className="form">
          <form onSubmit={onSubmit}>
            <h1 className="Title">
              Sign up
            </h1>
            {errors && <div className="alert">
                {Object.keys(errors).map(key => (
                  <p key={key}>{errors[key][0]}</p>
                  ))}
              </div>
            }
            <input ref={nameRef} placeholder="Full Name"/>
            <input ref={emailRef} type="email" placeholder="Email Address"/>
            <input ref={passwordRef} type="password" placeholder="Password"/>
            <input ref={passwordConfirmationRef} type="password" placeholder="Password Confirmation"/>
            <button className="btn btn-block">Sign up</button>
            <p className="message">
              Already Registered? <Link to="/Login">Sign in</Link>
            </p>

          </form>
        </div>
      </div>
    )
}
