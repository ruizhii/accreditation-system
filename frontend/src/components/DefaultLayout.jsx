import { Link, Navigate, Outlet } from 'react-router-dom';
import { useStateContext } from '../contexts/ContextProvider';
import {useEffect, useState} from "react";
import axiosClient from "../axios-client.js";

export default function DefaultLayout() {
  const {user,token,notification,setUser,setToken} = useStateContext()
  const [users,setUsers] = useState({
    name:null,
    role:null,
    permissions: {},
  })

  
  

  const onLogout = (ev) => {
    ev.preventDefault()

    axiosClient.post('/logout')
      .then(() => {
        setUser({})
        setToken(null)
      })
  }




  useEffect(( ) => {
    getUser()
    // getAssignment()
  } , [])

  // Return user data to the server
  const getUser = () => {
    axiosClient.get('/user')
      .then(({data}) => {
        setUser(data)
      })
    axiosClient.get('/profile')
      .then(({data}) => {
        setUsers(data.user)
      })
  }

  const can = (permission) => {
  const userPermissions = users?.permissions;
  if (Array.isArray(userPermissions)){
    return userPermissions.find((p) => p == permission) ? true : false;
  }}

  if (!token) {
    return <Navigate to="/login" />
}
  return (
    <div id="defaultLayout">
        <aside>
            <Link to="/dashboard">Dashboard</Link>
            <Link to="/users">Users</Link>
            {can('access faculties')
             ? <Link to="/faculties">Faculties</Link>
             : ""
            };
            {can('access departments')
             ? <Link to="/departments">Departments</Link>
             : ""
            };
            {can('access programmes')
             ? <Link to="/academicprogrammes">Academic Programmes</Link>
             : ""
            };
            
        </aside>
      <div className="content">
        <header>
            <div>
                Header
            </div>
            <div>
                {user.name}
                <a href="#" onClick={onLogout} className="btn-logout">Logout</a>
            </div>
        </header>
        <main>
            <Outlet />
        </main>
    </div>
    {notification &&
      <div className="notification">
        {notification}
      </div>
    }
    </div>
  )
}
