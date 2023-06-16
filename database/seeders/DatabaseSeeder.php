<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Topic;
use App\Models\Year;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private array $topics = [
        'name' => '5th Semester',
        'type' => Topic::TYPE_SEMESTER,
        'children' => [
            [
                'name' => 'Peripheral and Interfacing',
                'code' => 'PI',
                'type' => Topic::TYPE_COURSE,
                'children' => [
                    [
                        'name' => 'Interfacing techniques',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [

                            [
                                'name' => 'Programmable parallel ports and handshake input/output (IC 8255)',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Interfacing a Microprocessor to keyboards',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'X-lat',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Display-Alphanumeric and multiplexed LED (Interfacing with IC 7447)',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Relay',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Stepper motor',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Incremental Encoder',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Optical motor shaft encoder.',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                        ]
                    ],
                    [
                        'name' => 'Digital Interfacing',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [

                            [
                                'name' => 'Scanners overview',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Bar code reader',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Optical mark reader (OMR)',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Optical Character Reader (OCR)',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Tape Reader',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                        ]

                    ],
                    [
                        'name' => 'Modern data-entry devices',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [

                            [
                                'name' => 'Reading technique',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Capacitive Electrostatic scanning digitizer.',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                        ]
                    ],
                    [
                        'name' => 'Display devices',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'CRT',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Basic CRT operations',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Timing and frequencies',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'CRT controller ICs',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'LCD technologies',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Passive and active matrix',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'LCD reliability',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Electroluminescent display.',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                        ]
                    ],
                    [
                        'name' => 'Printers',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [

                            [
                                'name' => 'Impact printers',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Serial and line printing',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Laser printing',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Ink-Jet printing',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Color printing',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Plotters.',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                        ]
                    ],
                    [
                        'name' => 'Storage devices',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [

                            [
                                'name' => 'Floppy disk',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Floppy disk controller (IC 8272) ',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Magnetic hard disk and controller',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Compact disk, magnetic tape storage.',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                        ]
                    ],
                    [
                        'name' => 'Data Communication and Network',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [

                            [
                                'name' => 'Introduction to asynchronous serial data communication',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'RS-232 C serial data standard',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'USART(IC 8251A) word format',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Null Modem configuration',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'The GPIB',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'HPIB',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'IEEE 488 Bus.',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                        ]
                    ],
                    [
                        'name' => 'Digitizer',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [

                            [
                                'name' => 'Reading technique',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Capacitive Electrostatic scanning digitizer.',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                        ]
                    ],
                ]
            ],
            [
                'name' => 'Data and Telecommunications',
                'code' => 'DT',
                'type' => Topic::TYPE_COURSE,
                'children' => [
                    [
                        'name' => 'Data Communication model',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'TCP/IP and OSI',
                                'type' => Topic::TYPE_TOPIC,
                            ], [
                                'name' => 'Data communication network components',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                        ]
                    ],
                    [
                        'name' => 'Different types of networks',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'Circuit switching, packet switching networks, ATM, HDLC and X.25',
                                'type' => Topic::TYPE_TOPIC,
                            ], [
                                'name' => 'Signal and random processes',
                                'type' => Topic::TYPE_TOPIC,
                            ], [
                                'name' => 'Review of Fourier transformation and Hilbert transformation',
                                'type' => Topic::TYPE_TOPIC,
                            ], [
                                'name' => 'Introduction to modulation techniques',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                        ]
                    ], [
                        'name' => 'Continuous wave modulation',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'AM, PM, FM',
                                'type' => Topic::TYPE_TOPIC,
                            ], [
                                'name' => 'Sampling theorem',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                        ]
                    ], [
                        'name' => 'Pulse modulation',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'PAM, PDM, PPM, PCM',
                                'type' => Topic::TYPE_TOPIC,
                            ], [
                                'name' => 'Companding',
                                'type' => Topic::TYPE_TOPIC,
                            ], [
                                'name' => 'Delta modulation',
                                'type' => Topic::TYPE_TOPIC,
                            ], [
                                'name' => 'Delta modulation',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Different PCM',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                        ]
                    ], [
                        'name' => 'Multiple access techniques',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'Delta modulation',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'TDM, FDM',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Quantization',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                        ]
                    ], [
                        'name' => 'Digital modulation',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'ASK, FSK, PSK, BPSK, QPSK',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Constellation',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Bit error rate (BER), noise',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Echo cancellation',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Intersymbol interference',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Probability of error for pulse systems',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Concepts of channel coding and capacity',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Asynchronous and synchronous communications',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Hardware interfaces, multiplexers, concentrators and buffer',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Communication media',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Fiber optics',
                                'type' => Topic::TYPE_TOPIC,
                            ],

                        ]
                    ], [
                        'name' => 'Wireless transmission',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'Propagation, path loss, fading, delay spread',
                                'type' => Topic::TYPE_TOPIC,
                            ],

                        ]
                    ], [
                        'name' => 'Spread spectrum',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'Frequency hopping spread spectrum and direct sequence spread spectrum',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'CDMA',
                                'type' => Topic::TYPE_TOPIC,
                            ],

                        ]
                    ], [
                        'name' => 'High speed digital access',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'DSL, SONET, SDH',
                                'type' => Topic::TYPE_TOPIC,
                            ],

                        ]
                    ], [
                        'name' => 'Error detection and Correction techniques',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'Parity check, CRC, block code and hamming code',
                                'type' => Topic::TYPE_TOPIC,
                            ],

                        ]
                    ], [
                        'name' => 'Flow and Error control techniques',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'Sliding window, stop and wait, ARQ and HDLC protocols',
                                'type' => Topic::TYPE_TOPIC,
                            ],

                        ]
                    ], [
                        'name' => 'Modes of communications',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'Simplex, Half-duplex and Full duplex',
                                'type' => Topic::TYPE_TOPIC,
                            ],

                        ]
                    ],


                ]
            ],
            [
                'name' => 'Operating System',
                'code' => 'OS',
                'type' => Topic::TYPE_COURSE,
                'children' => [
                    [
                        'name' => 'Introduction',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'Operating system overview',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Computer system structure',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Structure and components of an operating system',
                                'type' => Topic::TYPE_TOPIC,
                            ],

                        ],
                    ],
                    [
                        'name' => 'System calls',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'Class of system calls and description',
                                'type' => Topic::TYPE_TOPIC,
                            ],

                        ]
                    ],
                    [
                        'name' => 'Process and threads',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'Process and thread model',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Process and thread creation and termination',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'User and kernel level thread',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Scheduling',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Scheduling algorithms',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Dispatcher,',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Context switch',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Real time scheduling',
                                'type' => Topic::TYPE_TOPIC,
                            ],


                        ]
                    ],
                    [
                        'name' => 'Concurrency and synchronization',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'IPC and inter-thread communication',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Critical region',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Critical section problems and solutions',
                                'type' => Topic::TYPE_TOPIC,
                            ],

                        ]
                    ],
                    [
                        'name' => 'Resource management',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'Introduction to deadlock',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Ostrich algorithm',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Deadlock detection and recovery',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Deadlock avoidance',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Deadlock prevention',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Starvation.',
                                'type' => Topic::TYPE_TOPIC,
                            ],

                        ]
                    ],
                    [
                        'name' => 'File management',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'File Naming and structure',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'File access and attributes',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'System calls',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'File organization',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'OS and user perspective view of file,',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Memory mapped file',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'File directories organization',
                                'type' => Topic::TYPE_TOPIC,
                            ],


                        ]
                    ],
                    [
                        'name' => 'File System Implementation',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'Implementing file',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Allocation strategy',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Method of allocation',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Directory implementation,',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'UNIX i-node',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Block management',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Quota',
                                'type' => Topic::TYPE_TOPIC,
                            ],

                        ]
                    ],
                    [
                        'name' => 'Memory management',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'Basic memory management',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Fixed and dynamic partition',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Virtual memory',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Segmentation',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Paging and swapping',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'MMU',
                                'type' => Topic::TYPE_TOPIC,
                            ],

                        ]
                    ],
                    [
                        'name' => 'Virtual memory management',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'Paging',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Page table structure',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Page replacement',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'TLB, exception vector',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Demand paging and segmentation',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Thrashing and performance',
                                'type' => Topic::TYPE_TOPIC,
                            ],

                        ]
                    ],
                    [
                        'name' => 'Disk I/O management',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'Structure',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Performance',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Low-level disk formatting',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Disk arm scheduling algorithm',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Error handling',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Stable storage',
                                'type' => Topic::TYPE_TOPIC,
                            ],

                        ]
                    ],
                ]
            ],
            [
                'name' => 'Economics',
                'code' => 'ECO',
                'type' => Topic::TYPE_COURSE,
                'children' => [
                    [
                        'name' => 'Introduction',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            [
                                'name' => 'Definition',
                                'type' => Topic::TYPE_TOPIC,
                            ], [
                                'name' => 'Microeconomics vs. macroeconomics',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Scope of economics',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Meaning of economic theory',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Some basic concepts- product',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Commodity',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Want',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Utility',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Consumption',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                            [
                                'name' => 'Factors of production',
                                'type' => Topic::TYPE_TOPIC,
                            ],
                        ]
                    ],
                    [
                        'name' => 'Demand',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            ['name' => 'Law of demand', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Factors determining demand', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Shifts in demand', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Demand functions', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Deriving demand curves', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Substitution and income effects', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Deriving aggregate demands', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Various concepts of demand elasticity and measurements', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Discussion on the method of estimating demand functions and demand functions and demand forecasting', 'type' => Topic::TYPE_TOPIC,],
                        ]
                    ],
                    [
                        'name' => 'Supply',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            ['name' => 'Law of supply and supply function', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Determination of supply', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Shifts in supply', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Elasticity of supply', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Market equilibrium', 'type' => Topic::TYPE_TOPIC,],
                        ]
                    ],
                    [
                        'name' => 'Economic Theory of Consumer Behavior',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            ['name' => 'Reasons for consumption', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Principle of diminishing marginal utility', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Indifference Curves', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Budget Constraint', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Utility Maximization and Consumer Equilibrium', 'type' => Topic::TYPE_TOPIC,],
                        ]
                    ],
                    [
                        'name' => 'Consumer Demand',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            ['name' => 'Change in Budget Constraints', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Price Consumption Curve', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Income Consumption Curve', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Consumer Demand', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Market Demand', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Engel Curve', 'type' => Topic::TYPE_TOPIC,],
                        ]
                    ],
                    [
                        'name' => 'Production',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            ['name' => 'Production functions', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Total', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Average and marginal products', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Law of diminishing marginal physical products', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Production isoquants', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Marginal rate of technical substitution (MRTS)', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Optimal combination of inputs', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Expansion path', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Returns to scale', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Estimation of production function and estimation of cost function', 'type' => Topic::TYPE_TOPIC,],
                        ]
                    ],
                    [
                        'name' => 'Cost',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            ['name' => 'Concepts of cost', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Short-run costs', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Relation between short-run costs and production', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Long run costs', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Economies and dis-economies of scale', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Relation between short run and long run costs', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Cost function and estimation of cost function', 'type' => Topic::TYPE_TOPIC,],
                        ]
                    ],
                    [
                        'name' => 'Markets and Revenue',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            ['name' => 'Meaning of market', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Different forms of market', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Concepts of total', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Average and marginal revenue', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Relation between average revenue and marginal revenue curves', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Relation between different revenues and elasticity’s of demand', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Equilibrium of the firm', 'type' => Topic::TYPE_TOPIC,],
                        ]
                    ],
                    [
                        'name' => 'Price and Output',
                        'type' => Topic::TYPE_CHAPTER,
                        'children' => [
                            ['name' => 'Price and output determination under perfect competition', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Monopoly', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Monopolistic competition and oligopoly', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Profit maximization', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Price discrimination', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Plant shut down decision', 'type' => Topic::TYPE_TOPIC,],
                            ['name' => 'Barriers to entry.', 'type' => Topic::TYPE_TOPIC,],
                        ]
                    ],

                ]
            ],
        ]
    ];



    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'Test@example.com',
        ]);

        Topic::create($this->topics);

        for ($i = 2010; $i <= 2022; $i++) {
            Year::create(['no' => $i]);
        }
    }
}
