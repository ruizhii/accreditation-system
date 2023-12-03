import {useEffect, useState} from "react";
import {useStateContext} from "../contexts/ContextProvider.jsx";
import axiosClient from "../axios-client.js";
import {Link} from "react-router-dom";

export default function Departments() {
  const [departments, setDepartments] = useState([]);
  const [loading, setLoading] = useState(false);
  const {setNotification} = useStateContext()

  useEffect(() => {
    getDepartments();
  }, [])

  const onDeleteClick = department => {
    if (!window.confirm("Are you sure you want to delete this faculty?")) {
      return
    }

    axiosClient.delete(`/departments/${department.id}`)
      .then(() => {
        setNotification("Faculties was successfully deleted")
        getDepartments()
      })
  }

  const getDepartments = () => {
    setLoading(true)
    axiosClient.get('/departments')
      .then(({data}) => {
        setLoading(false)
        //console.log(data)
        setDepartments(data.data)
      })
      .catch(() => {
        setLoading(false)
      })
  }

  return (
    <div>
      <div style={{display: 'flex', justifyContent: 'space-between', allignItems: 'center'}}>
        <h1>Departments</h1>
        <Link to="/departments/new" className="btn-add">Add new</Link>
      </div>
      <div className="card animated fadeInDown">
        <table>
          <thead>
          <tr>
            <th>ID</th>
            <th>Department</th>
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
            {departments.map(d => (
              <tr key={d.id}>
                <td>{d.id}</td>
                <td>{d.name}</td>
                <td>{d.created_at}</td>
                <td>
                  <Link className="btn-edit" to={'/departments/' + d.id}>Edit</Link>
                  &nbsp;
                  <button className="btn-delete" onClick={ev => onDeleteClick(d)}>Delete</button>
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