import {useNavigate, useParams} from "react-router-dom";
import {useEffect, useState} from "react";
import {useStateContext} from "../contexts/ContextProvider.jsx";
import axiosClient from "../axios-client.js";

export default function AcademicProgrammeForm() {
    const {id} = useParams()
    const navigate = useNavigate()
    const [loading, setLoading] = useState(false)
    const [errors, setErrors] = useState(null)
    const{setNotification} = useStateContext()
    const [departments, setDepartments] = useState([])
    const [accredited_um, setAccredited_um] = useState([
      {
        name_location:'' , delivery_mode:'' , provisional_accreditation_status:'' , full_accreditation_status:''
      }
    ])
    const [teaching_method, setTeaching_method] = useState([
      {method:''}
    ])
    const [delivery_mode, setDelivery_mode] = useState({
      conventional:false, open_distance_learning:false
    })
    const [academicProgramme, setAcademicProgramme] = useState({
        id:null,
        name: '',
        mqf_level: '',
        mqr_no: '',
        required_graduating_credit: '',
        accredited_um: {},
        award_type: '',
        old_nec: '',
        new_nec: '',
        location_conducted: '',
        instruction_language: '',
        programme_type: '',
        programme_status: '',
        study_mode: '',
        offer_mode: '',
        teaching_method: {},
        delivery_mode: {},
        study_duration: '',
        first_intake_date: '',
        student_enrolment: {},
        graduation_date: '',
        graduate_job_type: {},
        awarding_body: {},
        scroll_awarded: '',
        programme_coordinator: {},
        department_id: null,
    })

    const handleAccredited_UMAdd = () => {
      setAccredited_um([...accredited_um, {
        name_location:'' , delivery_mode:'' , provisional_accreditation_status:'' , full_accreditation_status:''
      }])
    }
  
    const handleAccredited_UMRemove = (index) => {
      const list = [...accredited_um];
      list.splice(index, 1);
      setAccredited_um(list);
    }
  
    const handleAccredited_UMChange = (e, index) => {
      const {name,value} = e.target
      const list = [...accredited_um];
      list[index][name] = value;
      setAccredited_um(list);
      academicProgramme.accredited_um = accredited_um;
    };

    const handleTeachingMethodAdd = () => {
      setTeaching_method([...teaching_method, {method:''}])
    }
  
    const handleTeachingMethodRemove = (index) => {
      const list = [...teaching_method];
      list.splice(index, 1);
      setTeaching_method(list);
    }
  
    const handleTeachingMethodChange = (e, index) => {
      const {name,value} = e.target
      const list = [...teaching_method];
      list[index][name] = value;
      setTeaching_method(list);
      academicProgramme.teaching_method = teaching_method;
    };

    const handleDeliveryModeChange = (e) => {
        
    }

    useEffect(() => {
        getDepartments();
      }, [])

    if (id) {
        useEffect(() => {
          setLoading(true)
          axiosClient.get(`/academic_programmes/${id}`)
            .then(({data}) => {
              setLoading(false)
              setAcademicProgramme(data)
              setAccredited_um(data.accredited_um)
              setDelivery_mode(data.delivery_mode)
              setTeaching_method(data.teaching_method)
            })
            .catch(() => {
              setLoading(false)
            })
        }, [])
      }
    
      const getDepartments = () => {
        axiosClient.get('/departments')
        .then(({data}) => {
            setDepartments(data.data)
        })
    }
    
      const onSubmit = (ev) => {
        ev.preventDefault();
        if (academicProgramme.id) {
          axiosClient.put(`/academic_programmes/${academicProgramme.id}`, academicProgramme)
            .then(() => {
              setNotification("Academic programme was successfully updated")
              navigate('/academicprogrammes')
            })
            .catch(err => {
              const response = err.response;
              if (response && response.status === 422) {
                setErrors(response.data.errors)
              }
            })
        } else {
          axiosClient.post(`/academic_programmes`, academicProgramme)
            .then(() => {
              setNotification("Academic programme was successfully created")
              navigate('/academicprogrammes')
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
          {academicProgramme.id && <h1>Update Academic Programme: {academicProgramme.name}</h1>}
          {!academicProgramme.id && <h1>New Academic Programme: </h1>}
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
                <input value={academicProgramme.name} onChange={ev => setAcademicProgramme({...academicProgramme,name: ev.target.value})} placeholder="Programme name (as in the scroll to be awarded)"/>
                <div>
                <label>Choose a department:</label>
                <select value={academicProgramme.department_id} onChange={ev => setAcademicProgramme({...academicProgramme,department_id: ev.target.value})}>
                  <option key="choose" value="">Select</option>
                    {departments.map(({name,id}) => (
                        <option key={id} value={id}>{name}</option>
                    ))}
                </select>
                </div>
                <div>
                <input value={academicProgramme.mqf_level} onChange={ev => setAcademicProgramme({...academicProgramme,mqf_level: ev.target.value})} placeholder="MQF level"/>
                <input value={academicProgramme.mqr_no} onChange={ev => setAcademicProgramme({...academicProgramme,mqr_no: ev.target.value})} placeholder="MQR no"/>
                <input value={academicProgramme.required_graduating_credit} onChange={ev => setAcademicProgramme({...academicProgramme,required_graduating_credit: ev.target.value})} placeholder="Graduating credit"/>

                </div>
                Has this programme been accredited by UM for other premises? If yes, please provide provide the following details:
              &nbsp;
                <table class="table_form_student">
              <tr>
                <th rowSpan="2">No.</th>
                <th rowSpan="2">Name and Location of the Premises (main campus/ branch campuses / regional centre)</th>
                <th rowSpan="2">Mode of Delivery</th>
                <th colSpan="2">Accreditation Status</th>
              </tr>
              <tr>
                <th>Provisional</th>
                <th>Full</th>
              </tr>
              {accredited_um.map((aum, index) => (
              <tr key = {index}>
                <th class="difRow">{index+1}</th>
                <td ><input name="name_location" value={aum.name_location} onChange={(e) => handleAccredited_UMChange(e, index)}/></td>
                <td><input name="delivery_mode" value={aum.delivery_mode} onChange={(e) => handleAccredited_UMChange(e, index)}/></td>
                <td><input name="provisional_accreditation_status" value={aum.provisional_accreditation_status} onChange={(e) => handleAccredited_UMChange(e, index)}/></td>
                <td><input name="full_accreditation_status" value={aum.full_accreditation_status} onChange={(e) => handleAccredited_UMChange(e, index)}/></td>
                {accredited_um.length - 1 === index &&
                (
                  <button type="button" className="add-btn"
                  onClick={handleAccredited_UMAdd}
                  >
                    <span>+</span>
                  </button>
                )}
                {accredited_um.length > 1 && (
                  <button type="button" className="remove-btn"
                  onClick={() => handleAccredited_UMRemove(index)}
                  >
                    <span>-</span>
                  </button>
                )}
              </tr>
              ))}
            </table>
            
              <div>
                <input value={academicProgramme.award_type} onChange={ev => setAcademicProgramme({...academicProgramme,award_type: ev.target.value})} placeholder="Type of award (e.g., sibgle major, double major, etc.)"/>
                <input value={academicProgramme.old_nec} onChange={ev => setAcademicProgramme({...academicProgramme,old_nec: ev.target.value})} placeholder="Old NEC"/>
                <input value={academicProgramme.new_nec} onChange={ev => setAcademicProgramme({...academicProgramme,new_nec: ev.target.value})} placeholder="New NEC"/>
                <input value={academicProgramme.instruction_language} onChange={ev => setAcademicProgramme({...academicProgramme,instruction_language: ev.target.value})} placeholder="Language of instruction"/>
                <input value={academicProgramme.programme_type} onChange={ev => setAcademicProgramme({...academicProgramme,programme_type: ev.target.value})} placeholder="Type of programme"/>
               </div> 
                <div>
                <label>Mode of study:</label>
                <select value={academicProgramme.study_mode} onChange={ev => setAcademicProgramme({...academicProgramme,study_mode: ev.target.value})}>
                  <option selected key="0" value="full_time">Choose mode of study</option>
                  <option key="1" value="full_time">full-time</option>
                  <option key="2" value="part_time">part-time</option>
                </select>
                </div>
                {/* Show only one  */}
                <div>
                <label>Undergraduate/Diploma Programme:</label>
                <select value={academicProgramme.offer_mode} onChange={ev => setAcademicProgramme({...academicProgramme,offer_mode: ev.target.value})}>
                  <option selected key="0">Choose mode of offer</option>
                  <option key="1" value="coursework">Coursework</option>
                  <option key="2" value="industry_mode">Industry Mode (2u2i)</option>
                </select>
                </div>
                <div>
                <label>Postgraduate Programme:</label>
                <select value={academicProgramme.offer_mode} onChange={ev => setAcademicProgramme({...academicProgramme,offer_mode: ev.target.value})}>
                  <option selected key="0">Choose mode of offer</option>
                  <option key="1" value="coursework">Coursework</option>
                  <option key="2" value="mixed_mode">Mixed mode</option>
                  <option key="3" value="research">Research</option>
                </select>
                </div>
                <div>
                Method of learning and teaching (e.g. lecture/tutorial/lab/fieldwork/studio/blended learning/e-learning, etc.)
              &nbsp;
                <table class="table_form_student">
              <tr>
              <th>List all Method of Teaching and Learning</th>
              </tr>
              {teaching_method.map((tm, index) => (
              <tr key = {index}>
                <td width="55%"><input name="method" value={tm.method} onChange={(e) => handleTeachingMethodChange(e, index)}/></td>
                {teaching_method.length - 1 === index &&
                (
                  <button type="button" className="add-btn"
                  onClick={handleTeachingMethodAdd}
                  >
                    <span>+</span>
                  </button>
                )}
                {teaching_method.length > 1 && (
                  <button type="button" className="remove-btn"
                  onClick={() => handleTeachingMethodRemove(index)}
                  >
                    <span>-</span>
                  </button>
                )}
              </tr>
              ))}
              </table>
              </div>

              <div class="form-checkbox">
              <label>
              <input
                type="checkbox"
                name="conventional"
                checked={delivery_mode.conventional}
                onChange={(e) => {
                  setDelivery_mode({
                    ...delivery_mode,
                    [e.target.name]:e.target.checked
                  })
                  setAcademicProgramme({
                    ...academicProgramme,
                    delivery_mode:delivery_mode
                  })
                  console.log(academicProgramme.delivery_mode)
                }}
              />Conventional
              </label>
              </div>
              <div>
              <label>
              <input
                type="checkbox"
                name="open_distance_learning"
                checked={delivery_mode.open_distance_learning}
                 onChange={(e) => {
                  setDelivery_mode({
                    ...delivery_mode,
                    [e.target.name]:e.target.checked
                  })
                  
                  setAcademicProgramme({
                    ...academicProgramme,
                    delivery_mode:delivery_mode
                  })
                  console.log(academicProgramme.delivery_mode)
                }}
               />Open and Distance Learning (ODL)
              </label>
              </div>

                
              

                <button onClick={onSubmit} className="btn">Save</button>
              </form>
            }
          </div>
        </>
      )
    
}
