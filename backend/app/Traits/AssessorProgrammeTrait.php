<?php

namespace App\Traits;

trait AssessorProgrammeTrait
{
    public function createAssessorProgrammeArea($assessorProgramme)
    {
        $areas = [
            1 => [
                'sections' => [
                    '1.1' => [
                        'title' => 'Statement of Educational Objectives of Academic Programme and Learning Outcomes',
                        'subSections' => [
                            '1.1.1' => [
                                'standard_coppa' => 'The programme must be consistent with, and supportive of, the vision, mission and goals of the HEP.',
                                'keys_element' => 'Must be in consistent with, and supportive of, the vision, mission and goals of the HEP. ',
                                'evidence' => '1) Minutes of meeting on discussion on how the program (PEO and PLO and program contents) is consistent with the vision, mission and goals of the HEP'
                            ],
                            '1.1.2' => [
                                'standard_coppa' => 'The programme must be considered only after a needs assessment has indicated that there is a need for the programme to be offered.',
                                'keys_element' => 'Must have needs analysis (show the demand for this programme)',
                                'evidence' => '2) Evidence indicating interest of potential candidates to join this program: (Online survey of potential candidates and/or potential candidates respond during open day and/or  exhibition and/or other relevant information)\n3) Evidence indicating interest of potential employer to hire the graduates: (Online survey of potential employers and/or minutes of focus group discussion and/or other evidences.)\n4) Survey or data extracted from other studies on potential employment (in the government or private sector) for the graduates: type of jobs and the corresponding numbers of workers required.\n5) Survey on graduate employability.\n6) Report on Benchmarking with other similar programs (to indicate the niche for this program in the country)'
                            ],
                            '1.1.3' => [
                                'standard_coppa' => 'The department must state its programme educational objectives, learning outcomes, teaching and learning strategies, and assessment, and ensure constructive alignment between them.',
                                'keys_element' => 'Must define its educational objectives, learning outcomes, learning and teaching strategies, and assessment',
                                'evidence' => '7) Minutes of meeting with stakeholders on defining the PEO and PLO.'
                            ],
                            '1.1.4' => [
                                'standard_coppa' => 'The programme learning outcomes must correspond to an MQF level descriptors and MQF learning outcomes domains: (refer to MQF 2nd Edition for the 5 clusters of learning outcome/appendix 1 and 2)',
                                'keys_element' => 'Must correspond to the Malaysian Qualification Framework (MQF)',
                                'evidence' => '8) Minutes of JK Kurikulum Jabatan discussing on mapping of PLO to PEO, MQF, program standard(if available) and/or other standards (if available)'
                            ],
                            '1.1.5' => [
                                'standard_coppa' => 'Considering the stated learning outcomes, the programme must indicate the career and further studies options available to the students on completion of the programme.',
                                'keys_element' => 'Must indicate the career and further studies options available',
                                'evidence' => '9) Survey of competencies with market needs. (Employer needs survey)\n10) Minutes of JK Kurikulum Jabatan discussing on mapping of student competency with further studies requirements.'
                            ],
                        ]
                    ],
                    '1.2' => [
                        'title' => 'Programme Development: Process, Content, Structure and Learning- Teaching Methods',
                        'subSections' => [
                            '1.2.1' => [
                                'standard_coppa' => 'The department must have sufficient autonomy to design the curriculum and to utilise the allocated resources necessary for its implementation. (Where applicable, the above provision must also cover collaborative programmes and programmes conducted in collaboration with or from, other HEPs in accordance with national policies.)',
                                'keys_element' => 'Must have sufficient autonomy.',
                                'evidence' => '1)   Letter of appointment to the curriculum review committee. (TOR should indicate (i) autonomy to design the curriculum. (ii) autonomy to utilize allocated resources available to the department)'
                            ],
                            '1.2.2' => [
                                'standard_coppa' => 'The department must have an appropriate process to develop the curriculum leading to the approval by the highest academic authority in the HEP. (This standard must be read together with Standard 1.1.2 in Area 1 and 6.1.6 in Area 6)',
                                'keys_element' => 'Must have an appropriate process.',
                                'evidence' => '2) Processes on Curriculum review (Can refer UM-PT01-PK03 Perkembangan Kurikulum Ijazah Dasar)\n3) Evidences that CR reach the highest academic authority (Minutes of Faculty approval on CR; Senate approval letter for the current curriculum)'
                            ],
                            '1.2.3' => [
                                'standard_coppa' => 'The department must consult the stakeholders in the development of the curriculum, including education experts as appropriate. (This standard must be read together with Standard 7.1.4 in Area 7)',
                                'keys_element' => 'Must consult the stakeholders, including education experts.',
                                'evidence' => '4) Minutes of meeting with stakeholders (Alumni, industry etc) on the curriculum.\n5) Minutes of meeting with educational experts on the curriculum.'
                            ],
                            '1.2.4' => [
                                'standard_coppa' => 'The curriculum must fulfil the requirements of the discipline of study, taking into account the appropriate programme standards, professional and industry requirements as well as good practices in the field.',
                                'keys_element' => 'Must fulfil the requirements of the discipline of study.',
                                'evidence' => '6) Form 1 and Form 2 (As required by COPPA Table 3)\n7) Forms 3,4,5,6 of all the courses (As required by COPPA Table 4)'
                            ],
                            '1.2.5' => [
                                'standard_coppa' => 'There must be appropriate learning and teaching methods relevant to the programme educational objectives and learning outcomes.',
                                'keys_element' => 'Must have appropriate learning and teaching methods.',
                                'evidence' => '8) Table showing constructive alignment PLO-CLO-Teaching-Assessment. This is produced from the consolidation of Form 3 into a single form where the CLOs are grouped into PLO.(Note: Although Table, it is placed as evidence as this will be used in Area 2 as well)'
                            ],
                            '1.2.6' => [
                                'standard_coppa' => 'There must be co-curricular activities to enrich student experience, and to foster personal development and responsibility. (This standard may not be applicable to Open and Distance Learning [ODL] programmes and programmes designed for working adult learners.)',
                                'keys_element' => 'Must have co-curricular activities.',
                                'evidence' => '9) Supporting evidences of the co-curricular activities (e.g. minutes, feedbacks survey, pictures etc.)'
                            ],
                        ]
                    ],
                    '1.3' => [
                        'title' => 'Programme Delivery',
                        'subSections' => [
                            '1.3.1' => [
                                'standard_coppa' => 'The department must take responsibility to ensure the effective delivery of programme learning outcomes.',
                                'keys_element' => 'Must ensure the effective delivery of programme learning outcomes.',
                                'evidence' => '1) Form 7 (for the past 3 years) for all the courses\n2) Minutes of discussion on Form 7 and the CQI involved\n3) Form 9 (PLO measurement) for the past 3 years (for full, 1 year is sufficient) with CQI actions\n4) Minutes of discussion on PLO results and the CQI involved.\n5) Evidence on other methods to ensure effectiveness of delivery (if available)'
                            ],
                            '1.3.2' => [
                                'standard_coppa' => 'Students must be provided with, and briefed on, current information about (among others) the objectives, structure, outline, schedule, credit value, learning outcomes, and methods of assessment of the programme at the commencement of their studies.',
                                'keys_element' => 'Must provide current information of the programme.',
                                'evidence' => '6) Student handbook\n7) Student study guide, student project handbook or others evidence to inform the students on course delivery and assessment (if available)'
                            ],
                            '1.3.3' => [
                                'standard_coppa' => 'The programme must have an appropriate full-time coordinator and a team of academic staff (e.g., a programme committee) with adequate authority for the effective delivery of the programme. (This standard must be read together with related Programme Standards and Guidelines to Good Practices, and with Standards 6.1.1 and 6.2.2 in Area 6)',
                                'keys_element' => 'Must have appropriate full-time coordinator and a team of academic staff. Must have appropriate full-time coordinator and a team of academic staff. ',
                                'evidence' => '8) Letter of appointment for the management team of the program and their TOR (stating their authority and responsibility)'
                            ],
                            '1.3.4' => [
                                'standard_coppa' => 'The department must provide students with a conducive learning environment. (This standard must be read together with Standard 5.1.1 in Area 5)',
                                'keys_element' => 'Must provide a conducive learning environment.',
                                'evidence' => '9) Pictures of the learning environment.'
                            ],
                            '1.3.5' => [
                                'standard_coppa' => 'The department must encourage innovations in teaching, learning and assessment.',
                                'keys_element' => 'Must encourage innovations.',
                                'evidence' => '10) Evidences showing encouragement of innovative teaching: E.g.\n11) Supporting evidences on the innovative initiatives that has been carried out'
                            ],
                            '1.3.6' => [
                                'standard_coppa' => 'The department must obtain feedback from stakeholders to improve the delivery of the programme outcomes.',
                                'keys_element' => 'Must obtain feedback from stakeholders.',
                                'evidence' => '12) Survey of students satisfaction on courses (CTES for the past 3 years)\n13) External Programme Assessor report on the PO attainment\n14) Industrial Training feedback on the PO attainment'
                            ],
                        ]
                    ],
                ],
            ],
            2 => [
                'sections' => [
                    '2.1' => [
                        'title' => 'Relationship between Assessment and Learning Outcomes',
                        'subSections' => [
                            '2.1.1' => [
                                'standard_coppa' => 'Assessment principles, methods and practices must be aligned to the learning outcomes of the programme, consistent with the levels defined in the MQF.',
                                'keys_element' => 'Must be aligned to, and consistent with, MQF',
                                'evidence' => '1) Refer to reference for 1.2.5'
                            ],
                            '2.1.2' => [
                                'standard_coppa' => 'The alignment between assessment and the learning outcomes in the programme must be systematically and regularly reviewed to ensure its effectiveness.',
                                'keys_element' => 'Must be regularly reviewed to ensure effectiveness',
                                'evidence' => '2) Policy or mechanism on reviewing the assessment\n3) Minutes of meeting on discussion of the alignment between assessment and the learning outcomes'
                            ],
                        ]
                    ],
                    '2.2' => [
                        'title' => 'Assessment Methods',
                        'subSections' => [
                            '2.2.1' => [
                                'standard_coppa' => 'There must be a variety of methods and tools that are appropriate for the assessment of learning outcomes and competencies.',
                                'keys_element' => 'Must have a variety of methods and tools.',
                                'evidence' => '1) Refer to reference for 1.2.5\n2) Sample of Formative assessment for all the PLO\n3) Sample of continuous assessment for all the PLO (Questions and marking scheme (rubrics))\n4) Sample of Summative assessment for all the PLO. (Questions and marking scheme)'
                            ],
                            '2.2.2' => [
                                'standard_coppa' => 'There must be mechanisms to ensure, and to periodically review, the validity, reliability, integrity, currency and fairness of the assessment methods.',
                                'keys_element' => 'Must have mechanisms to ensure and review validity, reliability, integrity, currency and fairness.',
                                'evidence' => '5) Policy or procedure for the moderation process\n6) Filled moderation form for final examination and filled moderation forms for other assessment methods (if available)\n7) Guidelines to address student plagiarism\n8) Minutes of meeting showing review of assessment methods'
                            ],
                            '2.2.3' => [
                                'standard_coppa' => 'The frequency, methods, and criteria of student assessment - including the grading system and appeal policies - must be documented and communicated to students on the commencement of the programme.',
                                'keys_element' => 'Must be documented and communicated to students.',
                                'evidence' => '9) Evidences that assessment methods (duration, diversity, weight, criteria and coverage) are communicated to students\n10) Policy on the grading system\n11) Evidences that grading system is publicized (Screenshot in website and/or buku panduan)'
                            ],
                            '2.2.4' => [
                                'standard_coppa' => 'Changes to student assessment methods must follow established procedures and regulations, and be communicated to students prior to their implementation.',
                                'keys_element' => 'Must follow established procedures and regulations for changes.',
                                'evidence' => '12) Procedure for changing student assessment methods. (E.g. GP Online TNL /Surat dari TNC A)\n13) Evidences that the changes in assessment methods are communicated to the students'
                            ],
                        ]
                    ],
                    '2.3' => [
                        'title' => 'Management of Student Assessment',
                        'subSections' => [
                            '2.3.1' => [
                                'standard_coppa' => 'The department and its academic staff must have adequate level of autonomy in the management of student assessment. ',
                                'keys_element' => 'Must have adequate level of autonomy for department and staff.',
                                'evidence' => '1) Letter of appointment on the management of student assessment. (Penyelaras peperiksaan, surat kuasa ambil kertas soalan, moderator kertas peperiksaan, etc) '
                            ],
                            '2.3.2' => [
                                'standard_coppa' => 'There must be mechanisms to ensure the security of assessment documents and records.',
                                'keys_element' => 'Must have mechanisms to ensure the security of assessment documents and records.',
                                'evidence' => '2) Supporting evidences (can be surat kerahsiaan, policy on password protection, guideline for setting exam question in a secure manner, picture of the bilik kebal, etc)'
                            ],
                            '2.3.3' => [
                                'standard_coppa' => 'The assessment results must be communicated to students before the commencement of a new semester to facilitate progression decision.',
                                'keys_element' => 'Must communicate to students before the commencement of a new semester.',
                                'evidence' => '3) Evidences that feedback on assessment is provided to students\n4) Evidence final result is given before the registration of the new semester. (Maya screenshot and also schedule of exam handling-highlight the date of publishing results)'
                            ],
                            '2.3.4' => [
                                'standard_coppa' => 'The department must have appropriate guidelines and mechanisms for students to appeal their course results.',
                                'keys_element' => 'Must have mechanisms for students to appeal.',
                                'evidence' => '5) Documented appeal policy\n6) Mechanism for the appeal process\n7) Evidences appeal policy is communicated to students \n8) Sample of one student going through the appeal process (if available)'
                            ],
                            '2.3.5' => [
                                'standard_coppa' => 'The department must periodically review the management of student assessment and act on the findings of the review.',
                                'keys_element' => 'Must be periodically reviewed.',
                                'evidence' => '9) Minutes of meeting on discussion on the management of student assessment'
                            ],
                        ]
                    ],
                ],
            ],
            3 => [
                'sections' => [
                    '3.1' => [
                        'title' => 'Student Selection',
                        'subSections' => [
                            '3.1.1' => [
                                'standard_coppa' => 'The programme must have clear criteria and processes for student selection (including that of transfer students) and these must be consistent with applicable requirements.',
                                'keys_element' => 'Must have clear criteria and processes.',
                                'evidence' => '1) Policy and mechanism on student selection\n2) Policy and mechanism on accepting “non-conventional” students (visiting, auditing, exchange and transfer)\n3) Policy on student with special needs\n4) Student admission criteria\n5) Sample of student selection process. (if available)\n6) Sample of student transfer. (Incoming and outgoing)'
                            ],
                            '3.1.2' => [
                                'standard_coppa' => 'The criteria and processes of student selection must be transparent and objective. ',
                                'keys_element' => 'Must be transparent and objective.',
                                'evidence' => '7) Screenshot of criteria on student selection in the website/ newspaper cutting/handbook/ etc\n8) Screenshot of student selection process in the website or other places.'
                            ],
                            '3.1.3' => [
                                'standard_coppa' => 'Student enrolment must be related to the capacity of the department to effectively deliver the programme.',
                                'keys_element' => 'Must relate enrolment to the capacity of the department.',
                                'evidence' => '9) Official records of student intake.'
                            ],
                            '3.1.4' => [
                                'standard_coppa' => 'There must be a clear policy, and if applicable, appropriate mechanisms for appeal on student selection.',
                                'keys_element' => 'Must have a clear policy and appropriate mechanism for appeal (if applicable)',
                                'evidence' => '10) Official records of graduating student\n11) Other relevant information (E.g. screenshot showing the CR on the projected student intake, Minutes or letter to the university stating the student intake capacity for that year, etc)'
                            ],
                            '3.1.5' => [
                                'standard_coppa' => 'The department must offer appropriate developmental or remedial support to assist students, including incoming transfer students who are in need.',
                                'keys_element' => 'Must offer appropriate developmental or remedial support.',
                                'evidence' => '12) Policy for appeal on student selection (Can refer to UM-PT01-PK01-AK016-Urusan Rayuan Kemasukan Pelajar Baharu (Sarjana Muda)\n13) Sample of a student appeal on the selection (if available)\n14) Evidences showing the existence and implementation of the remedial support such as letters:, minutes, picture, etc. '
                            ],
                        ]
                    ],
                    '3.2' => [
                        'title' => 'Articulation and Transfer',
                        'subSections' => [
                            '3.2.1' => [
                                'standard_coppa' => 'The department must have well-defined policies and mechanisms to facilitate student mobility which may include student transfer within and between institutions as well as cross-border. ',
                                'keys_element' => 'Must have well-defined policies and mechanisms to facilitate student mobility',
                                'evidence' => '1) Policy to facilitate student mobility\n2) Mechanism to facilitate student mobility (GEM/ ISC)\n3) Credit transfer policy for outbound student\n4) Sample of credit transfer implementation for outbound student (if applicable)'
                            ],
                            '3.2.2' => [
                                'standard_coppa' => 'The department must ensure that the incoming transfer students have the capacity to successfully follow the programme.',
                                'keys_element' => 'Must ensure that the incoming transfer students have the capacity to successfully follow the programme. integrity, currency and fairness.',
                                'evidence' => '5) Policy on incoming students\n6) Sample of screening on incoming transfer student (if applicable)'
                            ],
                        ]
                    ],
                    '3.3' => [
                        'title' => 'Student Support Services',
                        'subSections' => [
                            '3.3.1' => [
                                'standard_coppa' => 'Students must have access to appropriate and adequate support services such as physical, social, financial, recreational and online facilities, academic and non-academic counselling, and health services.',
                                'keys_element' => 'Must have access to appropriate and adequate support services.',
                                'evidence' => '1) Pictures of the support service'
                            ],
                            '3.3.2' => [
                                'standard_coppa' => 'There must be a designated administrative unit with a prominent organisational status in the HEP responsible for planning and implementing student support services and staffed by individuals who have appropriate experience.',
                                'keys_element' => 'Must have a designated administrative unit.',
                                'evidence' => '2) Organization Chart of HEP and their functions'
                            ],
                            '3.3.3' => [
                                'standard_coppa' => 'An effective induction to the programme must be available to new students with special attention given to out-of-state and international students as well as students with special needs.',
                                'keys_element' => 'Must have an effective induction programme.',
                                'evidence' => '3) Evidence of the orientation of incoming student. E.g. Letters, pictures.\n4) Survey on the student on the effectiveness of the induction program. '
                            ],
                            '3.3.4' => [
                                'standard_coppa' => 'Academic, non-academic and career counselling must be provided by adequate and qualified staff.',
                                'keys_element' => 'Must have academic, non-academic and career counselling services.',
                                'evidence' => '5) CV of the counsellors\n6) Academic advisors and their related experience and training on academic and career counselling\n7) Evidences on the effectiveness of the counselling service'
                            ],
                            '3.3.5' => [
                                'standard_coppa' => 'There must be mechanisms that actively identify and assist students who are in need of academic, spiritual, psychological and social support.',
                                'keys_element' => 'Must have mechanisms that actively identify and assist students.',
                                'evidence' => '8) Letters or minutes that informed lecturers on these mechanisms. \n9) Process and procedure in handling disciplinary cases among students.(E.g. AUKU amendment 2012; University Malaya (Students Discipline) Rules 1999; University Malaya (Student Bodies) Statut 1979.)'
                            ],
                            '3.3.6' => [
                                'standard_coppa' => 'The HEP must have clearly defined and documented processes and procedures in handling student disciplinary cases.',
                                'keys_element' => 'Must have clear processes and procedures for disciplinary cases.',
                                'evidence' => '10) Sample of handling disciplinary cases.'
                            ],
                            '3.3.7' => [
                                'standard_coppa' => 'There must be an active mechanism for students to voice their grievances and seek resolution on academic and non-academic matters.',
                                'keys_element' => 'Must have an active mechanism for students to voice their grievances.',
                                'evidence' => '11) Evidences that students are informed on these mechanism.'
                            ],
                            '3.3.8' => [
                                'standard_coppa' => 'Student support services must be evaluated regularly to ensure their adequacy, effectiveness and safety',
                                'keys_element' => 'Must be evaluated regularly.',
                                'evidence' => '12) Minutes of meeting on the CQI of Student support services'
                            ],
                        ]
                    ],
                    '3.4' => [
                        'title' => 'Student Representation and Participation',
                        'subSections' => [
                            '3.4.1 and 3.4.2' => [
                                'standard_coppa' => 'There must be well-disseminated policies and processes for active student engagement especially in areas that affect their interest and welfare.\nThere must be adequate student representation and organisation at the institutional and departmental levels.',
                                'keys_element' => 'Must have well-disseminated policies and processes for active student engagement.\nMust have adequate student representation and organisation.',
                                'evidence' => '1) Policy and process for active student engagement\n2) Evidence that the policy and process is well disseminated\n3) Evidence on student representation or engagement (letter, minutes, picture)'
                            ],
                            '3.4.3' => [
                                'standard_coppa' => 'Students must be facilitated to develop linkages with external stakeholders and to participate in activities to gain managerial, entrepreneurial and leadership skills in preparation for workplace.',
                                'keys_element' => 'Must facilitate student linkages with external stakeholders and participation in relevant activities.',
                                'evidence' => '4) Evidence on departmental efforts to link student to industry (Letters, minutes, etc)'
                            ],
                            '3.4.4' => [
                                'standard_coppa' => 'Student activities and organisations must be facilitated to encourage character building, inculcate a sense of belonging and responsibility, and promote active citizenship.',
                                'keys_element' => 'Must facilitate students’ character building.',
                                'evidence' => '5) Evidence on departmental efforts to assist student activties (Letters, minutes, approvals, allocations, etc)'
                            ],
                        ]
                    ],
                    '3.5' => [
                        'title' => 'Alumni',
                        'subSections' => [
                            '3.5.1' => [
                                'standard_coppa' => 'The department must foster active linkages with alumni to develop, review and continually improve the programme. There must be adequate student representation and organisation at the institutional and departmental levels.',
                                'keys_element' => 'Must foster active linkages with alumni to develop, review and continually improve the programme',
                                'evidence' => '1) Evidence of the Database of the alumni (if available) (Can be screenshot or report or whatever evidence)\n2) Evidences of alumni activities (Pictures, minutes etc)\n3) Evidence of alumni involvement in curriculum review (Minutes, Surveys etc)'
                            ],
                        ]
                    ],
                ],
            ],
            4 => [
                'sections' => [
                    '4.1' => [
                        'title' => 'Recruitment and Management',
                        'subSections' => [
                            '4.1.1' => [
                                'standard_coppa' => 'The department must have a clearly defined plan for its academic manpower needs that is consistent with institutional policies and programme requirements. ',
                                'keys_element' => '4.1.1 Must have clearly defined plan for academic manpower needs.',
                                'evidence' => '1) Minutes of meeting on academic man power planning'
                            ],
                            '4.1.2 and 4.1.6' => [
                                'standard_coppa' => 'The department must have a clear and documented academic staff recruitment policy where the criteria for selection are based primarily on academic merit and/or relevant experience.\nThe recruitment policy for a particular programme must seek diversity among the academic staff in terms of experience, approaches and backgrounds.',
                                'keys_element' => '4.1.2 Must have clear and documented recruitment policy.\n4.1.6 Must seek diversity among the academic staff.',
                                'evidence' => '2) Recruitment policy (Can refer UM-PT03-PK02 Urusan Pengambilan dan Penempatan Staf)\n3) Minutes of meeting of recruitment committee\n4) Sample of a recruitment process of a new academic staff'
                            ],
                            '4.1.3' => [
                                'standard_coppa' => 'The staff–student ratio for the programme must be appropriate to the learning-teaching methods and comply with the programme standards for the discipline. ',
                                'keys_element' => '4.1.3 Must maintain appropriate staff–student ratio.',
                                'evidence' => ''
                            ],
                            '4.1.4' => [
                                'standard_coppa' => 'The department must have adequate and qualified academic staff responsible for implementing the programme. The expected ratio of full-time and part-time academic staff is 60:40. ',
                                'keys_element' => '4.1.4 Must have adequate and qualified academic staff.',
                                'evidence' => '5) Provide CV (hyperlink) for all the academic staff teaching this program according to the COPPA format '
                            ],
                            '4.1.5' => [
                                'standard_coppa' => 'The policy of the department must reflect an equitable distribution of responsibilities among the academic staff. ',
                                'keys_element' => '4.1.5 Must have policy reflecting equitable distribution of responsibilities.',
                                'evidence' => '6) Policy on equitable workload distribution of responsibilities\n7) Minutes of meeting (if applicable)'
                            ],
                            '4.1.7' => [
                                'standard_coppa' => 'Policies and procedures for recognition through promotion, salary increment or other remuneration must be clear, transparent and based on merit. ',
                                'keys_element' => '4.1.7 Must have clear, transparent and merit-based policies and procedures for recognition.',
                                'evidence' => '8) Policy on recognizing staff in professional and academic involvement at national and international levels\n9) Policy on promotion and salary increment\n10) Evidences that the promotion and salary increment policy is made known to the academic staff\n11) Evidences that KPI takes into account of staff involvement in professional, academic and other relevant activities, at national and international levels'
                            ],
                            '4.1.8' => [
                                'standard_coppa' => 'The department must have national and international linkages to provide for the involvement of experienced academics, professionals and practitioners in order to enhance learning and teaching in the programme.',
                                'keys_element' => '4.1.8 Must have national and international linkages to enhance learning and teaching.',
                                'evidence' => '12) Reports on the activities of MoU and MoA that has been carried out'
                            ],
                        ]
                    ],
                    '4.2' => [
                        'title' => 'Service and Development ',
                        'subSections' => [
                            '4.2.1' => [
                                'standard_coppa' => 'The department must have policies addressing matters related to service, development and appraisal of the academic staff. ',
                                'keys_element' => '4.2.1 Must have policies addressing matters related to service, development and appraisal.',
                                'evidence' => '1) Policy on service, development and appraisal of the academic staff'
                            ],
                            '4.2.2 and 4.2.6 and 4.2.7' => [
                                'standard_coppa' => 'The department must provide opportunities for academic staff to focus on their respective areas of expertise.\nThe HEP must provide opportunities for academic staff to participate in professional, academic and other relevant activities, at national and international levels to obtain professional qualifications to enhance learning-teaching experience.\nThe department must encourage and facilitate its academic staff to play an active role in community and industrial engagement activities.',
                                'keys_element' => '4.2.2 Must provide opportunities on areas of expertise.\n4.2.6 Must provide opportunities to participate in professional, academic and other relevant activities at national and international levels.\n4.2.7 Must encourage to play an active role in community and industrial engagements.',
                                'evidence' => '2) Evidences on the type of cuti (berkursus/ sabbatical/ others)\n3) Evidence of monetary sponsorship.\n4) UMCARES activities/ call for grants\n5) UPUM function\n6) Minutes of department encouraging community and industrial engagements.\n7) KPI requirements on community and industrial engagements'
                            ],
                            '4.2.3' => [
                                'standard_coppa' => 'The HEP must have clear policies on conflict of interest and professional conduct, including procedures for handling disciplinary cases among academic staff. ',
                                'keys_element' => 'Must have clear policies on conflict of interest and professional conduct.',
                                'evidence' => '8) Policies on conflict of interest and professional conduct\n9) Procedures for handling disciplinary cases\n10) Sample of handling disciplinary cases'
                            ],
                            '4.2.4' => [
                                'standard_coppa' => 'The HEP must have mechanisms and processes for periodic student evaluation of the academic staff for quality improvement. ',
                                'keys_element' => 'Must have mechanisms and processes for periodic student evaluation.',
                                'evidence' => '11) Mechanism of student evaluation UM-PT01-PK01-AK012 PENILAIAN KURSUS DAN PENGAJARAN\n12) Screenshot of CTES question\n13) CTES data\n14) Minutes on CTES analysis and actions'
                            ],
                            '4.2.5' => [
                                'standard_coppa' => 'The department must have a development programme for new academic staff and continuous professional enhancement for existing staff. ',
                                'keys_element' => 'Must have development programme for new staff and continuous professional enhancement.',
                                'evidence' => '15) ADeC yearly plan on teaching and learning.\n16) List of program (seminar, workshop, training, etc.) organized by faculty or department.'
                            ],
                        ]
                    ],
                ],
            ],
            5 => [
                'sections' => [
                    '5.1' => [
                        'title' => 'Physical Facilities',
                        'subSections' => [
                            '5.1.1 and 5.1.2' => [
                                'standard_coppa' => 'The programme must have sufficient and appropriate physical facilities and educational resources to ensure its effective delivery, including facilities for practical-based programmes and for those with special needs.\nThe physical facilities must comply with the relevant laws and regulations.',
                                'keys_element' => '5.1.1 Must have sufficient and appropriate physical facilities and educational resources.\n5.1.2 Must comply with the relevant laws and regulations.',
                                'evidence' => '1) Pictures of the teaching and learning facilities\n2) Snapshot/ pictures on licensing of software\n3) Evidence of compliance or audit checking (E.g. Email, stickers, reports, etc)'
                            ],
                            '5.1.3' => [
                                'standard_coppa' => 'The library or resource centre must have adequate and up-to-date reference materials and qualified staff that meet the needs of the programme and research amongst academic staff and students.',
                                'keys_element' => 'Must have adequate and up-to- date reference materials and qualified staff in the library or resource centre.',
                                'evidence' => '4) Screenshot or documents stating the services provided by the library\n5) Pictures of the learning space in the library. '
                            ],
                            '5.1.4' => [
                                'standard_coppa' => 'The educational resources, services and facilities must be maintained and periodically reviewed to improve quality and appropriateness.',
                                'keys_element' => 'Must maintain and periodically review.',
                                'evidence' => '6) Evidence that the educational resources, services and facilities is maintained and periodically reviewed to improve quality and appropriateness'
                            ],
                        ]
                    ],
                    '5.2' => [
                        'title' => 'Research and Development',
                        'subSections' => [
                            '5.2.1' => [
                                'standard_coppa' => 'The department must have a research policy with adequate facilities and resources to sustain it. ',
                                'keys_element' => 'Must have research policy with adequate facilities and resources.',
                                'evidence' => '1) Research Policy\n2) Picture of the research facilities\n3) Evidences of research grants that has been received. (Can be screenshot from the RGMS or letters from sponsors or other evidences)'
                            ],
                            '5.2.2' => [
                                'standard_coppa' => 'The interaction between research and learning must be reflected in the curriculum, influence current teaching, and encourage and prepare students for engagement in research, scholarship and development. ',
                                'keys_element' => 'Must show interaction between research and learning in the curriculum.',
                                'evidence' => '4) Evidences such as (screen shot of spectrum where the method is implement, feedback from students, minutes of meetings, grant letter, etc)'
                            ],
                            '5.2.3' => [
                                'standard_coppa' => 'The department must periodically review its research resources and facilities, and take appropriate action to enhance its research capabilities and to promote a conducive research environment. ',
                                'keys_element' => 'Must periodically review research resources and facilities.',
                                'evidence' => '5) Minutes of meeting on the review of the research resources and facilities as well as the CQI that has been carried out'
                            ],
                        ]
                    ],
                    '5.3' => [
                        'title' => 'Financial Resources',
                        'subSections' => [
                            '5.3.1' => [
                                'standard_coppa' => 'The HEP must demonstrate financial viability and sustainability for the programme.',
                                'keys_element' => 'Must demonstrate financial viability and sustainability.',
                                'evidence' => '1) Relevant financial documentation to support the explanation '
                            ],
                            '5.3.2' => [
                                'standard_coppa' => 'The department must have clear procedures to ensure that its financial resources are sufficient and efficiently managed. ',
                                'keys_element' => 'Must have a clear line of responsibility and authority for budgeting and resource allocation',
                                'evidence' => '2) SOP or related Quality Document\n3) Snapshot of where the organizational chart is displayed/ available. '
                            ],
                            '5.3.3' => [
                                'standard_coppa' => 'The HEP must have a clear line of responsibility and authority for budgeting and resource allocation that takes into account the specific needs of the department. ',
                                'keys_element' => 'Must have clear procedures to ensure that financial resources are sufficient.',
                                'evidence' => '4) SOP or related Quality Document\n5) Financial Plan - Department and HEP \n6) Meeting minutes discuss on financial plan, budgeting, problem and improvement plan (latest with at least 2 examples)'
                            ],
                        ]
                    ],
                ],
            ],
            6 => [
                'sections' => [
                    '6.1' => [
                        'title' => 'Programme Management',
                        'subSections' => [
                            '6.1.1' => [
                                'standard_coppa' => 'The department must clarify its management structure and function, and the relationships between them, and these must be communicated to all parties involved based on the principles of responsibility, accountability and transparency. ',
                                'keys_element' => 'Must clarify its management structure and function, and the relationships between them must be communicated to all parties involved (principles of responsibility, accountability and transparency)',
                                'evidence' => '1) Picture of Organizational chart in department (or program or faculty or institute. Whichever is relevant)\n2) Website with above information'
                            ],
                            '6.1.2' => [
                                'standard_coppa' => 'The department must provide accurate, relevant and timely information about the programme which are easily and publicly accessible, especially to prospective students. ',
                                'keys_element' => 'Must provide accurate, relevant and timely information about the programme easily and publicly accessible, especially prospective students.',
                                'evidence' => '3) Arahan kerja on preparation of guidebook\n4) Appointment letter of committee of program book\n5) Meeting minutes (reporting planning & execution)\n6) Final programme handbook & link to website (Can just refer to the earlier evidence in area 1)\n7) Other announcements/ emails if communicated'
                            ],
                            '6.1.3' => [
                                'standard_coppa' => 'The department must have policies, procedures and mechanisms for regular reviewing and updating of its structures, functions, strategies and core activities to ensure continual quality improvement. ',
                                'keys_element' => 'Must have policies, procedures and mechanisms for regular reviewing and updating of its structures, functions, strategies and core activities to ensure CQI',
                                'evidence' => '8) Arahan kerja\n9) Committee appointment letter & ToR\n10) Annual Performance Review (KPI)  '
                            ],
                            '6.1.4' => [
                                'standard_coppa' => 'The academic board of the department must be an effective decision making body with an adequate degree of autonomy. ',
                                'keys_element' => 'Must have an effective decision-making body with an adequate degree of autonomy.',
                                'evidence' => '11) Appointment letter & term of reference\n12) Meeting minutes capturing decisions by academic board pertaining to programme'
                            ],
                            '6.1.5' => [
                                'standard_coppa' => 'Mechanisms to ensure functional integration and comparability of educational quality must be established for programmes conducted in different campuses or partner institutions.',
                                'keys_element' => 'Mechanisms to ensure functional integration and comparability of educational quality must be established for programmes conducted in different campuses or partner institutions.',
                                'evidence' => '13) MoU/MoA with the partner institutions.'
                            ],
                            '6.1.6' => [
                                'standard_coppa' => 'The department must conduct internal and external consultations, market needs and graduate employability analyses.',
                                'keys_element' => 'Must conduct internal and external consultations, market needs and graduate employability analyses.',
                                'evidence' => '14) Minutes of meeting with the students (staff student meeting or town hall meeting) and the CQI actions\n15) Minutes of meeting with the alumni and industry (Industrial advisory panel) and the CQI actions\n16) External examiner report and the CQI actions\n17) Survey on graduate employability and the analysis of it'
                            ],
                        ]
                    ],
                    '6.2' => [
                        'title' => 'Programme Leadership',
                        'subSections' => [
                            '6.2.1' => [
                                'standard_coppa' => 'The criteria for the appointment and the responsibilities of the programme leader must be clearly stated. ',
                                'keys_element' => 'Must clearly state the criteria for the appointment and the responsibilities of the programme leader.',
                                'evidence' => '1) Minutes of meeting or discussion on the criteria for appointment of the programme leader. AND/OR\n2) Letter of appointment stating the responsibilities of the programme leader'
                            ],
                            '6.2.2' => [
                                'standard_coppa' => 'The programme leader must have appropriate qualification, knowledge and experiences related to the programme he/she is responsible for. ',
                                'keys_element' => 'Must have appropriate qualification, knowledge and experiences related to the programme.',
                                'evidence' => '3) Comparison of the CV of the programme leader with the criteria. '
                            ],
                            '6.2.3' => [
                                'standard_coppa' => 'There must be mechanisms and processes for communication between the programme leader, department and HEP on matters such as staff recruitment and training, student admission, allocation of resources and decision making processes.',
                                'keys_element' => 'Must have mechanisms and processes for communication between the programme leader, department and HEP.',
                                'evidence' => '4) Mechanisms and processes for communication\n5) Minutes of meeting where programme leader, department and HEP discuss on matters such as staff recruitment and training, student admission, allocation of resources and decision-making processes'
                            ],
                        ]
                    ],
                    '6.3' => [
                        'title' => 'Administrative Staff',
                        'subSections' => [
                            '6.3.1' => [
                                'standard_coppa' => 'The department must have a sufficient number of qualified administrative staff to support the implementation of the programme and related activities. ',
                                'keys_element' => 'Must have sufficient number of qualified administrative staff.',
                                'evidence' => '1) CV of the support staff'
                            ],
                            '6.3.2' => [
                                'standard_coppa' => 'The HEP must conduct regular performance review of the programme administrative staff. ',
                                'keys_element' => 'Must conduct regular performance review.',
                                'evidence' => '2) Kpi screenshot of system (may remove sensitive details)\n3) List of outstanding performers from the department/programme'
                            ],
                            '6.3.3' => [
                                'standard_coppa' => 'The department must have an appropriate training scheme for the advancement of the administrative staff as well as to fulfil the specific needs of the programme.',
                                'keys_element' => 'Must have appropriate training scheme for career advancement and to fulfil programme needs.',
                                'evidence' => '4) Competency list\n5) Training matrix for staff (and should show that they fulfill the min number of days required in a year)\n6) Measured effectiveness of training (screenshot from system)'
                            ],
                        ]
                    ],
                    '6.4' => [
                        'title' => 'Academic Records',
                        'subSections' => [
                            '6.4.1' => [
                                'standard_coppa' => 'The department must have appropriate policies and practices concerning the nature, content and security of student, academic staff and other academic records. ',
                                'keys_element' => 'Must have appropriate policies and practices concerning the nature, content and security of academic records.',
                                'evidence' => '1) Pengurusan fail & rekod UM\n2) Show the umportal screenshot as well to indicate easy accessibility.3) Screenshot of maya student portal\n4) Exam scripts preparation & handling SOPs'
                            ],
                            '6.4.2' => [
                                'standard_coppa' => 'The department must maintain student records relating to their admission, performance, completion and graduation in such form as is practical and preserve these records for future reference. ',
                                'keys_element' => 'Must maintain student records in such form as is practical and preserve these records for future reference.',
                                'evidence' => '5) Record example at departmental level (may remove sensitive/personal information)'
                            ],
                            '6.4.3' => [
                                'standard_coppa' => 'The department must implement policies on the rights of individual privacy and the confidentiality of records. ',
                                'keys_element' => 'Must implement policies on the rights of individual privacy and the confidentiality of records.',
                                'evidence' => '6) Sample of signed Surat kerahsiaan\n7) Picture [Secure location for confidential records (with CCTV, access control)]\n8) List of PICs allowed for confidential locations'
                            ],
                            '6.4.4' => [
                                'standard_coppa' => 'The department must continually review policies on the security of records, including the increased use of electronic technologies and safety systems.',
                                'keys_element' => 'Must continually review policies on the security of records.',
                                'evidence' => '9) Version number changes of policies\n10) Meeting minutes discussing review of policies and how to improve'
                            ],
                        ]
                    ],
                ],
            ],
            7 => [
                'sections' => [
                    '7.1' => [
                        'title' => 'Mechanisms for Programme Monitoring, Review and Continual Quality Improvement',
                        'subSections' => [
                            '7.1.1' => [
                                'standard_coppa' => 'The department must have clear policies and appropriate mechanisms for regular programme monitoring and review. ',
                                'keys_element' => 'Must have clear policies and appropriate mechanisms.',
                                'evidence' => '1) Policies and mechanisms for regular monitoring and review of the programme.\n2) Garis Panduan Penetapan Nomenklatur Program. Akademik, Kod Program dan Kod Kursus Universiti Malaya].\n3) Procedure on ASP for CR. Extract from (Unit Perancangan dan Pemantauan Akademik) (Permohonan Semakan Kurikulum Program Akademik (UM portal –PTj Info))\n4) Arahan Kerja for the Programme monitoring and review (QMEC website for UM-PT01- PK03 and UM-PT01-PK04)'
                        ],
                            '7.1.2' => [
                                'standard_coppa' => 'The department must have a Quality Assurance (QA) unit for internal quality assurance of the department to work hand-in-hand with the QA unit of the HEP. ',
                                'keys_element' => 'Must have a Quality Assurance unit.',
                                'evidence' => '5) Letter of appointment (with TOR) of members [JK Kurikulum Peringkat Jabatan dan PTj;  Programme coordinator, ProQAE; Quality Committee organizational Chart].\n6) Minutes of meeting of the JK Kualiti PTj\n7) Minutes of QMMR meeting'
                            ],
                            '7.1.3' => [
                                'standard_coppa' => 'The department must have an internal programme monitoring and review committee with a designated head responsible for continual review of the programme to ensure its currency and relevancy.',
                                'keys_element' => 'Must have an internal monitoring and review committee.',
                                'evidence' => '8) Minutes of the JK Kurikulum Jabatan (and/or Fakulti).'
                            ],
                            '7.1.4' => [
                                'standard_coppa' => 'The departmental review system must constructively engage stakeholders, including the alumni and employers as well as external experts whose views are taken into consideration. (This standard must be read together with Standard 1.2.3 in Area 1). ',
                                'keys_element' => 'Must engage stakeholders in programme review.',
                                'evidence' => '9) Minutes of meeting of the JK Kurikulum [membership of industry + alumni] \n10) Minutes on CQI for the comments from the different stakeholders (if available)\n11) PLP appointment letter and term of reference; \n12) PLP report; \n13) Program report on action taken based on PLP report'
                            ],
                            '7.1.5' => [
                                'standard_coppa' => 'The department must make the programme review report accessible to stakeholders. ',
                                'keys_element' => 'Must make the programme review report accessible to stakeholders.',
                                'evidence' => ''
                            ],
                            '7.1.6' => [
                                'standard_coppa' => 'Various aspects of student performance, progression, attrition, graduation and employment must be analysed for the purpose of continual quality improvement.',
                                'keys_element' => 'Must analyse student performance for the purpose of continual quality improvement.',
                                'evidence' => '14) Minutes on discussing the student performance, progression, attrition, graduation and employment and the continual quality improvement suggested and implemented.\n15) Borang 8: Laporan tahunan (UM-PT01-MQF-BR008): Laporan Tahunan for the past 3 years\n16) UM-PT01-MQF-BR009: Analisis Hasil Pembelajaran Program for the past 3 cohorts\n17) PEO assessment report for CR (for provisional and full accreditation, the PEO assessment plan needs to be available)\n18) Tracer study'
                            ],
                            '7.1.7' => [
                                'standard_coppa' => 'In collaborative arrangements, the partners involved must share the responsibilities of programme monitoring and review. (This standard must be read together with Standard 6.1.4 in Area 6) ',
                                'keys_element' => 'Must share the responsibilities of programme monitoring and review with partner in collaborative arrangements.',
                                'evidence' => '19) Minutes of meeting with Collaborators; communication with collaborators; sample input from collaborators'
                            ],
                            '7.1.8' => [
                                'standard_coppa' => 'The findings of a programme review must be presented to the HEP for its attention and further action.',
                                'keys_element' => 'Must present the findings of programme review to the HEP.',
                                'evidence' => '20) Minutes of meeting (JK Kurikulum) discussing the results of programme review\n21) Report on the achievement of CLOs and PLOs. (BR008 and BR009 presented to the faculty Curriculum review report presented to the faculty).'
                            ],
                            '7.1.9' => [
                                'standard_coppa' => 'There must be an integral link between the departmental quality assurance processes and the achievement of the institutional purpose.',
                                'keys_element' => 'Must have an integral link between the departmental quality assurance processes and the achievement of the institutional purpose.',
                                'evidence' => ''
                            ],
                        ]
                    ],
                ],
            ],
        ];

        foreach ($areas as $areaId => $area) {
            $assessorProgrammeArea = $assessorProgramme->assessorProgrammeAreas()->create([
                'area' => $areaId,
                'progress_percentage' => 0,
            ]);

            foreach ($area['sections'] as $sectionId => $section) {
                $assessorProgrammeSection = $assessorProgrammeArea->assessorProgrammeSections()->create([
                    'section' => $sectionId,
                    'title' => $section['title']
                ]);

                foreach ($section['subSections'] as $subSectionId => $subSection) {
                    $assessorProgrammeSection->assessorProgrammeSubs()->create([
                        'sub' => $subSectionId,
                        'standard_coppa' => $subSection['standard_coppa'],
                        'keys_element' => $subSection['keys_element'],
                        'evidence' => $subSection['evidence']
                    ]);
                }
            }
        }
    }
}
