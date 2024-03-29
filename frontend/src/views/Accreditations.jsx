import {useEffect, useState} from "react";
import {useStateContext} from "../contexts/ContextProvider.jsx";
import axiosClient from "../axios-client.js";
import {Link} from "react-router-dom";

export default function Accreditations() {
    const [accreditations, setAccreditations] = useState([]);
    const [loading, setLoading] = useState(false);
    const {setNotification} = useStateContext()
    const [programmes, setProgrammes] = useState([])
    const [users,setUsers] = useState({
      name:null,
      role:null,
      permissions: {},
    })

    useEffect(() => {
        getData();
        getProgrammes();
      }, [])

      const onDeleteClick = accreditation => {
        if (!window.confirm("Are you sure you want to delete this accreditation?")) {
          return
        }
        axiosClient.delete(`/accreditation/${accreditation.id}`)
      .then(() => {
        setNotification("Accreditation was successfully deleted")
        getData()
      })
  } 

  const getData = () => {
    setLoading(true)
    axiosClient.get('/accreditations')
      .then(({data}) => {
        setLoading(false)
        setAccreditations(data.data)
      })
      .catch(() => {
        setLoading(false)
      })
      axiosClient.get('/profile') // Return user data to the server
      .then(({data}) => {
        setUsers(data.user)
      })
  }

  const getProgrammes = () => {
    axiosClient.get('/academic_programmes')
    .then(({data}) => {
        setProgrammes(data.data)
    })
}

  const can = (permission) => {
    const userPermissions = users?.permissions;
    if (Array.isArray(userPermissions)){
      return userPermissions.find((p) => p == permission) ? true : false;
    }}


  return (
    <div>
      <div style={{display: 'flex', justifyContent: 'space-between', allignItems: 'center'}}>
        <h1>Accreditations</h1>
        {can('create accreditations')
         ? <Link to="/accreditations/new" className="btn-add">Add new</Link>
         : ""
        }
        
      </div>
      <div className="card animated fadeInDown">
        <table>
          <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Academic Programme</th>
            <th>Status</th>
            <th>Create Date</th>
            <th>Actions</th>
          </tr>
          </thead>
          {loading &&
            <tbody>
            <tr>
              <td colSpan="5" className="text-center">
                Loading...
              </td>
            </tr>
            </tbody>
          }
          {!loading &&
            <tbody>
            {accreditations.map(a => (
              <tr key={a.id}>
                <td>{a.id}</td>
                <td>{a.title}</td>
                
                <td>{a.academic_programme_id}</td>
                <td>{a.status}</td>
                <td>{a.created_at}</td>
                <td>
                  <Link className="btn-edit" to={'/accreditations/' + a.id}>Edit</Link>
                  &nbsp;
                  <button className="btn-delete" onClick={ev => onDeleteClick(a)}>Delete</button>
                </td>
              </tr>
            ))}
            </tbody>
          }
        </table>
      </div>
    </div>
    )
}