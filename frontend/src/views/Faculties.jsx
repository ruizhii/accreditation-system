import {useEffect, useState} from "react";
import {useStateContext} from "../contexts/ContextProvider.jsx";
import axiosClient from "../axios-client.js";
import {Link} from "react-router-dom";

export default function Faculties() {
  const [faculties, setFaculties] = useState([]);
  const [loading, setLoading] = useState(false);
  const {setNotification} = useStateContext()

  useEffect(() => {
    getFaculties();
  }, [])

  const onDeleteClick = faculty => {
    if (!window.confirm("Are you sure you want to delete this faculty?")) {
      return
    }

    axiosClient.delete(`/faculties/${faculty.id}`)
      .then(() => {
        setNotification("Faculties was successfully deleted")
        getFaculties()
      })
  }

  const getFaculties = () => {
    setLoading(true)
    axiosClient.get('/faculties')
      .then(({data}) => {
        setLoading(false)
        //console.log(data)
        setFaculties(data.data)
      })
      .catch(() => {
        setLoading(false)
      })
  }

  return (
    <div>
      <div style={{display: 'flex', justifyContent: 'space-between', allignItems: 'center'}}>
        <h1>Faculties</h1>
        <Link to="/faculties/new" className="btn-add">Add new</Link>
      </div>
      <div className="card animated fadeInDown">
        <table>
          <thead>
          <tr>
            <th>ID</th>
            <th>Faculty</th>
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
            {faculties.map(f => (
              <tr key={f.id}>
                <td>{f.id}</td>
                <td>{f.name}</td>
                <td>{f.created_at}</td>
                <td>
                  <Link className="btn-edit" to={'/faculties/' + f.id}>Edit</Link>
                  &nbsp;
                  <button className="btn-delete" onClick={ev => onDeleteClick(f)}>Delete</button>
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