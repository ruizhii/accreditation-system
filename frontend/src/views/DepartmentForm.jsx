import {useNavigate, useParams} from "react-router-dom";
import {useEffect, useState} from "react";
import {useStateContext} from "../contexts/ContextProvider.jsx";
import axiosClient from "../axios-client.js";

export default function DepartmentForm() {
  const {id} = useParams()
  const navigate = useNavigate()
  const [loading, setLoading] = useState(false)
  const [errors, setErrors] = useState(null)
  const{setNotification} = useStateContext()
  const [faculties, setFaculties] = useState([])
  const [department, setDepartment] = useState({
    id:null,
    name: '', 
    faculty_id:null,
})

useEffect(() => {
    getFaculties();
  }, [])

const getFaculties = () => {
    axiosClient.get('/faculties')
      .then(({data}) => {
        setFaculties(data.data)
      })
  }

if (id) {
    useEffect(() => {
      setLoading(true)
      axiosClient.get(`/departments/${id}`)
        .then(({data}) => {
          setLoading(false)
          setDepartment(data)})
        .catch(() => {
          setLoading(false)
        })
    }, [])
  }

  

  const onSubmit = (ev) => {
    ev.preventDefault();
    if (department.id) {
      axiosClient.put(`/departments/${department.id}`, department)
        .then(() => {
          setNotification("Department was successfully updated")
          navigate('/departments')
        })
        .catch(err => {
          const response = err.response;
          if (response && response.status === 422) {
            setErrors(response.data.errors)
          }
        })
    } else {
      axiosClient.post(`/departments`, department)
        .then(() => {
          setNotification("Department was successfully created")
          navigate('/departments')
        })
        .catch(err => {
          const response = err.response;
          if (response && response.status === 422) {
            setErrors(response.data.errors)
          }
        })
    }
  }

  return (
    <>
      {department.id && <h1>Update Department: {department.name}</h1>}
      {!department.id && <h1>New Department: </h1>}
      <div className="card animated fadeInDown">
        {loading && (
          <div className="text-center">Loading...</div>
        )}
        {errors && <div className="alert">
          {Object.keys(errors).map(key => (
            <p key={key}>{errors[key][0]}</p>
          ))}
        </div>
        }
        {!loading &&
          <form onSubmit={onSubmit}>
            <input value={department.name} onChange={ev => setDepartment({...department,name: ev.target.value})} placeholder="Department name"/>
            <div>
            <label>Choose a faculty:</label>
            <select value={department.faculty_id} onChange={ev => setDepartment({...department,faculty_id: ev.target.value})}>
                {faculties.map(({name,id}) => (
                    <option key={id} value={id}>{name}</option>
                ))}
            </select>
            </div>

            <button onClick={onSubmit} className="btn">Save</button>
          </form>
        }
      </div>
    </>
  )

}