<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
     <link rel="stylesheet" href="assets/css/adminedit.css">
</head>

<body>

    @extends('layouts.app')

    @php


     @endphp

  <div class="ticket-raised-container" id="ticket-raised-container-admin-id">
        <div class="ticket-raised-header">
            <h2 class="ticket-raised-title">Tickets Raised</h2>
            <div class="ticket-raised-inbox-filters" id="ticket-raised-index-nbfc-sort-id">
                <span>Sort by: </span>
                <img src="assets/images/filter-icon.png" alt="Filters">
                <ul class="ticket-raised-sort-dropdown-nbfc" id="ticket-raised-sort-options-index-nbfc">
                    <li data-sort="az" onclick="sortTickets('az')">A-Z</li>
                    <li data-sort="za" onclick="sortTickets('za')">Z-A</li>
                    <li data-sort="newest" onclick="sortTickets('newest')" class="active">Newest</li>
                    <li data-sort="oldest" onclick="sortTickets('oldest')">Oldest</li>
                </ul>
            </div>
        </div>

        <div class="ticket-raised-tickets-container" id="ticket-raised-tickets-list">
            <!-- Ticket 1 -->
            <div class="ticket-raised-item" data-title="Student financial aid question" data-date="2025-02-15">
                <div class="ticket-raised-content">
                    Student financial aid question - Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                    eiusmod tempor incididunt ut labore et.
                    <span class="ticket-raised-date">2025-02-15</span>
                </div>
                <div class="ticket-raised-meta">
                    <div class="ticket-raised-meta-item">Student Counsellor</div>
                    <div class="ticket-raised-meta-item">15/02/2025</div>
                    <div class="ticket-raised-meta-item">Student</div>
                </div>
                <div class="ticket-raised-chat-icon-container">
                    <div class="ticket-raised-chat-icon">
                       <img src="assets/images/ticket-icon.png" alt="Message Icon" />
                    </div>
                </div>
            </div>

            <!-- Ticket 2 -->
            <div class="ticket-raised-item" data-title="Course registration deadline" data-date="2025-02-10">
                <div class="ticket-raised-content">
                    Course registration deadline - Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    <span class="ticket-raised-date">2025-02-10</span>
                </div>
                <div class="ticket-raised-meta">
                    <div class="ticket-raised-meta-item">Student Counsellor</div>
                    <div class="ticket-raised-meta-item">10/02/2025</div>
                    <div class="ticket-raised-meta-item">Student</div>
                </div>
                <div class="ticket-raised-chat-icon-container">
                    <div class="ticket-raised-chat-icon">
                        <img src="assets/images/ticket-icon.png" alt="Message Icon" />
                    </div>
                </div>
            </div>

            <!-- Ticket 3 with Read More -->
            <div class="ticket-raised-item" id="ticket3" data-title="Dormitory maintenance request"
                data-date="2025-02-05">
                <div class="ticket-raised-content">
                    <span class="ticket-raised-collapsed-text">
                        Dormitory maintenance request - Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore
                        et incididunt ut...
                    </span>
                    <span class="ticket-raised-expanded-text">
                        Dormitory maintenance request - Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore
                        et incididunt ut. This is the full expanded text that shows all the details of this particular
                        ticket with more information.
                        <div class="ticket-raised-show-less-container">
                            <a href="#" class="ticket-raised-show-less" onclick="toggleTicket('ticket3', event)">Show
                                Less</a>
                        </div>
                    </span>
                    <a href="#" class="ticket-raised-read-more" onclick="toggleTicket('ticket3', event)">Read More</a>
                    <span class="ticket-raised-date">2025-02-05</span>
                </div>
                <div class="ticket-raised-meta">
                    <div class="ticket-raised-meta-item">Student Counsellor</div>
                    <div class="ticket-raised-meta-item">05/02/2025</div>
                    <div class="ticket-raised-meta-item">Student</div>
                </div>
                <div class="ticket-raised-chat-icon-container">
                    <div class="ticket-raised-chat-icon">
                        <img src="assets/images/ticket-icon.png" alt="Message Icon" />
                    </div>
                </div>
            </div>

            <!-- Ticket 4 (expanded) -->
            <div class="ticket-raised-item ticket-raised-expanded" id="ticket4" data-title="Exam scheduling conflict"
                data-date="2025-01-28">
                <div class="ticket-raised-content">
                    <span class="ticket-raised-collapsed-text">
                        Exam scheduling conflict - Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore
                        et incididunt ut...
                    </span>
                    <span class="ticket-raised-expanded-text">
                        Exam scheduling conflict - Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore
                        et incididunt ut. iusmod tempor incididunt ut labore et.
                        <div class="ticket-raised-show-less-container">
                            <a href="#" class="ticket-raised-show-less" onclick="toggleTicket('ticket4', event)">Show
                                Less</a>
                        </div>
                    </span>
                    <a href="#" class="ticket-raised-read-more" onclick="toggleTicket('ticket4', event)">Read More</a>
                    <span class="ticket-raised-date">2025-01-28</span>
                </div>
                <div class="ticket-raised-meta">
                    <div class="ticket-raised-meta-item">Student Counsellor</div>
                    <div class="ticket-raised-meta-item">28/01/2025</div>
                    <div class="ticket-raised-meta-item">Student</div>
                </div>
                <div class="ticket-raised-chat-icon-container">
                    <div class="ticket-raised-chat-icon">
                       <img src="assets/images/ticket-icon.png" alt="Message Icon" />
                    </div>
                </div>
            </div>

            <!-- Ticket 5 -->
            <div class="ticket-raised-item" data-title="Scholarship application help" data-date="2025-01-20">
                <div class="ticket-raised-content">
                    Scholarship application help - Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    <span class="ticket-raised-date">2025-01-20</span>
                </div>
                <div class="ticket-raised-meta">
                    <div class="ticket-raised-meta-item">Student Counsellor</div>
                    <div class="ticket-raised-meta-item">20/01/2025</div>
                    <div class="ticket-raised-meta-item">Student</div>
                </div>
                <div class="ticket-raised-chat-icon-container">
                    <div class="ticket-raised-chat-icon">
                        <img src="assets/images/ticket-icon.png" alt="Message Icon" />
                    </div>
                </div>
            </div>

             <div class="ticket-raised-item" id="ticket6" data-title="Library access issues" data-date="2025-01-15">
        <div class="ticket-raised-content">
            <span class="ticket-raised-collapsed-text">
                Library access issues - Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et incididunt ut...
            </span>
            <span class="ticket-raised-expanded-text">
                Library access issues - Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et incididunt ut. This is the full expanded text that includes 
                detailed information about library access card problems and system login issues.
                <div class="ticket-raised-show-less-container">
                    <a href="#" class="ticket-raised-show-less" onclick="toggleTicket('ticket6', event)">Show Less</a>
                </div>
            </span>
            <a href="#" class="ticket-raised-read-more" onclick="toggleTicket('ticket6', event)">Read More</a>
            <span class="ticket-raised-date">2025-01-15</span>
        </div>
        <div class="ticket-raised-meta">
            <div class="ticket-raised-meta-item">Student Counsellor</div>
            <div class="ticket-raised-meta-item">15/01/2025</div>
            <div class="ticket-raised-meta-item">Student</div>
        </div>
        <div class="ticket-raised-chat-icon-container">
            <div class="ticket-raised-chat-icon">
                <img src="assets/images/ticket-icon.png" alt="Message Icon" />
            </div>
        </div>
    </div>

    <!-- Ticket 7 with Read More -->
    <div class="ticket-raised-item" id="ticket7" data-title="Campus parking permit" data-date="2025-01-12">
        <div class="ticket-raised-content">
            <span class="ticket-raised-collapsed-text">
                Campus parking permit - Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et incididunt ut...
            </span>
            <span class="ticket-raised-expanded-text">
                Campus parking permit - Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et incididunt ut. Extended details about parking permit 
                application process and zone assignment requests.
                <div class="ticket-raised-show-less-container">
                    <a href="#" class="ticket-raised-show-less" onclick="toggleTicket('ticket7', event)">Show Less</a>
                </div>
            </span>
            <a href="#" class="ticket-raised-read-more" onclick="toggleTicket('ticket7', event)">Read More</a>
            <span class="ticket-raised-date">2025-01-12</span>
        </div>
        <div class="ticket-raised-meta">
            <div class="ticket-raised-meta-item">Student Counsellor</div>
            <div class="ticket-raised-meta-item">12/01/2025</div>
            <div class="ticket-raised-meta-item">Student</div>
        </div>
        <div class="ticket-raised-chat-icon-container">
            <div class="ticket-raised-chat-icon">
                <img src="assets/images/ticket-icon.png" alt="Message Icon" />
            </div>
        </div>
    </div>

    <!-- Ticket 8 (without Read More) -->
    <div class="ticket-raised-item" data-title="Student ID replacement" data-date="2025-01-10">
        <div class="ticket-raised-content">
            Student ID replacement - Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
            <span class="ticket-raised-date">2025-01-10</span>
        </div>
        <div class="ticket-raised-meta">
            <div class="ticket-raised-meta-item">Student Counsellor</div>
            <div class="ticket-raised-meta-item">10/01/2025</div>
            <div class="ticket-raised-meta-item">Student</div>
        </div>
        <div class="ticket-raised-chat-icon-container">
            <div class="ticket-raised-chat-icon">
                <img src="assets/images/ticket-icon.png" alt="Message Icon" />
            </div>
        </div>
    </div>
</div>
            
        </div>
    </div>
 <script>
        // Toggle dropdown visibility
        document.getElementById('ticket-raised-index-nbfc-sort-id').addEventListener('click', function (e) {
            const dropdown = document.getElementById('ticket-raised-sort-options-index-nbfc');
            dropdown.classList.toggle('ticket-raised-visible');
            e.stopPropagation();
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function () {
            const dropdown = document.getElementById('ticket-raised-sort-options-index-nbfc');
            dropdown.classList.remove('ticket-raised-visible');
        });

        // Toggle ticket expansion
        function toggleTicket(id, event) {
            event.preventDefault();
            const ticket = document.getElementById(id);

            if (ticket.classList.contains('ticket-raised-expanded')) {
                // Collapse the ticket
                ticket.classList.remove('ticket-raised-expanded');
            } else {
                // Expand the ticket
                ticket.classList.add('ticket-raised-expanded');
            }
        }

        // Sort tickets function
        function sortTickets(sortType) {
            const ticketsContainer = document.getElementById('ticket-raised-tickets-list');
            const tickets = Array.from(ticketsContainer.getElementsByClassName('ticket-raised-item'));
            const activeSort = document.querySelector('.ticket-raised-active-sort');

            // Update active sort in dropdown
            const sortOptions = document.querySelectorAll('#ticket-raised-sort-options-index-nbfc li');
            sortOptions.forEach(option => {
                option.classList.remove('active');
                if (option.getAttribute('data-sort') === sortType) {
                    option.classList.add('active');
                }
            });

            // Update displayed sort option
            activeSort.textContent = sortType.charAt(0).toUpperCase() + sortType.slice(1);

            // Sort tickets based on selected option
            tickets.sort((a, b) => {
                switch (sortType) {
                    case 'az':
                        return a.getAttribute('data-title').localeCompare(b.getAttribute('data-title'));
                    case 'za':
                        return b.getAttribute('data-title').localeCompare(a.getAttribute('data-title'));
                    case 'newest':
                        return new Date(b.getAttribute('data-date')) - new Date(a.getAttribute('data-date'));
                    case 'oldest':
                        return new Date(a.getAttribute('data-date')) - new Date(b.getAttribute('data-date'));
                    default:
                        return 0;
                }
            });

            // Reappend sorted tickets
            tickets.forEach(ticket => {
                ticketsContainer.appendChild(ticket);
            });

            // Hide dropdown after selection
            document.getElementById('ticket-raised-sort-options-index-nbfc').classList.remove('ticket-raised-visible');
        }

        // Initialize with default sort (newest)
        document.addEventListener('DOMContentLoaded', function () {
            sortTickets('newest');
        });
    </script>
</body>

</html>