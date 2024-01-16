import {useNavigate, useParams} from "react-router-dom";
import {useEffect, useState} from "react";
import {useStateContext} from "../contexts/ContextProvider.jsx";
import axiosClient from "../axios-client.js";
import { WithContext as ReactTags } from 'react-tag-input';

const KeyCodes = {
  comma: 188,
  enter: 13,
};

const delimiters = [KeyCodes.comma, KeyCodes.enter];

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

    const [student_enrolment, setStudent_enrolment] = useState([
      {year:'', intake_upu:'', intake_satu:'', intake_rl:'',enrolment_upu:'', enrolment_satu:'', enrolment_rl:''}
    ])

    const [teaching_method, setTeaching_method] = useState([
      {method:''}
    ])
    const [delivery_mode, setDelivery_mode] = useState({
      conventional:false, open_distance_learning:false
    })
    const [tags, setTags] = useState([]);

    const [testFile, setTestFile] = useState("")

  const [programme_coordinator, setProgrammeCoordinator] = useState({
    name: '',
    designation: '',
    tel: '',
    fax: '',
    email: ''
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
        graduate_job_type: '',
        awarding_body: {},
        scroll_awarded: '',
        programme_coordinator: {},
        department_id: null,
    })

    const handleStudentAdd = () => {
      setStudent_enrolment([...student_enrolment, {year:'', intake_upu:'', intake_satu:'', intake_rl:'',enrolment_upu:'', enrolment_satu:'', enrolment_rl:''}])
    }

    const handleStudentRemove = (index) => {
      const list = [...student_enrolment];
      list.splice(index, 1);
      setStudent_enrolment(list);
    }
  
    const handleStudentChange = (e, index) => {
      const {name,value} = e.target
      const list = [...student_enrolment];
      list[index][name] = parseInt(value);
      list[index].year = index+1;
      setStudent_enrolment(list);
      academicProgramme.student_enrolment = student_enrolment;
    };

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

   function handleDeliveryModeChange(e) {
    setDelivery_mode({
      ...delivery_mode,
      [e.target.name]:e.target.checked
    })
   }

   const handleDelete = (i) => {
    setTags(tags.filter((tag, index) => index !== i));
  };

  const handleAddition = (tag) => {
    setTags([...tags, tag]);
  };

  const handleDrag = (tag, currPos, newPos) => {
    const newTags = tags.slice();

    newTags.splice(currPos, 1);
    newTags.splice(newPos, 0, tag);

    // re-render
    setTags(newTags);
  };

  const handleTagClick = (index) => {
    console.log('The tag at index ' + index + ' was clicked');
  };

  const handleFileChange = (e) => {
    setTestFile(e.target.files[0])
    console.log(testFile)
    setFaculty({
      ...faculty,
      organizational_chart:testFile
    })
  }

  const handleProgrammeCoordinatorChange = (e) => {
    setProgrammeCoordinator({
      ...programme_coordinator,
      [e.target.name]:e.target.value
    })
    faculty.programme_coordinator = programme_coordinator;
  };

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
              if(data.accredited_um.length!=0){setAccredited_um(data.accredited_um)}
              setDelivery_mode(data.delivery_mode)
              if(data.teaching_method.length!=0){setTeaching_method(data.teaching_method)}
              if(data.student_enrolment.length!=0){setStudent_enrolment(data.student_enrolment)}
              if(data.graduate_job_type.length!=0){setTags(data.graduate_job_type)}
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
        academicProgramme.delivery_mode = delivery_mode;
        academicProgramme.graduate_job_type = tags;
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
                <br></br>
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
            <br></br>
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
                  <option selected key="0" value="none">Choose mode of study</option>
                  <option key="1" value="full_time">full-time</option>
                  <option key="2" value="part_time">part-time</option>
                </select>
                </div>
                <br></br>
                {/* Show only one  */}
                <div className="flex-container">
                <label>Undergraduate/Diploma Programme:</label>
                <select value={academicProgramme.offer_mode} onChange={ev => setAcademicProgramme({...academicProgramme,offer_mode: ev.target.value})}>
                  <option selected key="0">Choose mode of offer</option>
                  <option key="1" value="coursework">Coursework</option>
                  <option key="2" value="industry_mode">Industry Mode (2u2i)</option>
                </select>&nbsp;<b>OR</b>&nbsp;
                <label>Postgraduate Programme:</label>
                <select value={academicProgramme.offer_mode} onChange={ev => setAcademicProgramme({...academicProgramme,offer_mode: ev.target.value})}>
                  <option selected key="0">Choose mode of offer</option>
                  <option key="1" value="coursework">Coursework</option>
                  <option key="2" value="mixed_mode">Mixed mode</option>
                  <option key="3" value="research">Research</option>
                </select>
                </div>
                <div>
                  <br></br>
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
              <br></br>
              Mode of delivery (please check as appropriate):
              <div class="form-checkbox">
              <label>
              <input
                type="checkbox"
                name="conventional"
                checked={delivery_mode.conventional}
                onChange={(e) => handleDeliveryModeChange(e)}
              />Conventional
              </label>
              </div>
              <div>
              <label>
              <input
                type="checkbox"
                name="open_distance_learning"
                checked={delivery_mode.open_distance_learning}
                 onChange={(e) => handleDeliveryModeChange(e)}
               /> Open and Distance Learning (ODL)
              </label>
              </div>
              <br></br>
                <div>
                <input value={academicProgramme.study_duration} onChange={ev => setAcademicProgramme({...academicProgramme,study_duration: ev.target.value})} placeholder="Duration of study (Sem/Year)"/>
                <input value={academicProgramme.first_intake_date} onChange={ev => setAcademicProgramme({...academicProgramme,first_intake_date: ev.target.value})} placeholder="Date of first intake (after the latest curriculum review) (month/year)"/>
                </div>
                <br></br>
                Total intake and enrolment of student: (Current session)
              &nbsp;
                <table class="table_form_intake_enrolment">
              <tr>
                <th rowSpan="2">Year</th>
                <th colSpan="3">Intake</th>
                <th colSpan="3">Enrolment</th>
              </tr>
              <tr>
                <th>UPU</th>
                <th>SATU</th>
                <th>RL</th>
                <th>UPU</th>
                <th>SATU</th>
                <th>RL</th>
              </tr>
              {student_enrolment.map((student, index) => (
              <tr key = {index}>
                <th class="difRow">{index+1}</th>
                <td ><input name="intake_upu" value={student.intake_upu} onChange={(e) => handleStudentChange(e, index)}/></td>
                <td><input name="intake_satu" value={student.intake_satu} onChange={(e) => handleStudentChange(e, index)}/></td>
                <td><input name="intake_rl" value={student.intake_rl} onChange={(e) => handleStudentChange(e, index)}/></td>
                <td><input name="enrolment_upu" value={student.enrolment_upu} onChange={(e) => handleStudentChange(e, index)}/></td>
                <td><input name="enrolment_satu" value={student.enrolment_satu} onChange={(e) => handleStudentChange(e, index)}/></td>
                <td><input name="enrolment_rl" value={student.enrolment_rl} onChange={(e) => handleStudentChange(e, index)}/></td>
                {student_enrolment.length - 1 === index &&
                (
                  <button type="button" className="add-btn"
                  onClick={handleStudentAdd}
                  >
                    <span>+</span>
                  </button>
                )}
                {student_enrolment.length > 1 && (
                  <button type="button" className="remove-btn"
                  onClick={() => handleStudentRemove(index)}
                  >
                    <span>-</span>
                  </button>
                )}
              </tr>
              ))}
            </table>
                
            <br></br>
                <div>
                <input value={academicProgramme.graduation_date} onChange={ev => setAcademicProgramme({...academicProgramme,graduation_date: ev.target.value})} placeholder="Estimated date of first graduation (after the latest curriculum review (month/year))"/>
                
                </div>
                <br></br>

                <div>
        <ReactTags
          tags={tags}
          //suggestions={suggestions}
          delimiters={delimiters}
          handleDelete={handleDelete}
          handleAddition={handleAddition}
          handleDrag={handleDrag}
          handleTagClick={handleTagClick}
          inputFieldPosition="bottom"
          autocomplete
          editable
        />
      </div>
      <br></br>
      Provide a sample of scroll awarded:
            &nbsp;
            <div>
            <input type="file" onChange={e => handleFileChange(e)}/>
            </div>
            Details of Programme Coordinator/ Administrative Manager:
            &nbsp;
            <div>
            <input name="name" value={programme_coordinator.name} onChange={ev => handleProgrammeCoordinatorChange(ev)} placeholder="Name and Title"/>
            <input name="designation" value={programme_coordinator.designation} onChange={ev => handleProgrammeCoordinatorChange(ev)} placeholder="Designation"/>
            <input name="tel" value={programme_coordinator.tel} onChange={ev => handleProgrammeCoordinatorChange(ev)} placeholder="Tel."/>
            <input name="fax" value={programme_coordinator.fax} onChange={ev => handleProgrammeCoordinatorChange(ev)} placeholder="Fax"/>
            <input name="email" value={programme_coordinator.email} onChange={ev => handleProgrammeCoordinatorChange(ev)} placeholder="Email"/>
            </div>
                <button onClick={onSubmit} className="btn">Save</button>
              </form>
            }
          </div>
        </>
      )
    
}
