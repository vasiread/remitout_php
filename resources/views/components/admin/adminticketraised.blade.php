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

      <div class="ticket-raised-tickets-container" id="ticket-raised-tickets-list"></div>


    </div>
    </div>
    <script>
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


        function sortTickets(sortType) {
            try {
                // Get container and ticket elements
                const ticketsContainer = document.getElementById('ticket-raised-tickets-list');
                if (!ticketsContainer) {
                    console.error('Tickets container not found');
                    return;
                }

                const tickets = Array.from(ticketsContainer.getElementsByClassName('ticket-raised-item'));
                if (tickets.length === 0) {
                    console.error('No ticket items found');
                    return;
                }

                // Update active sort in dropdown - safely
                const sortOptions = document.querySelectorAll('#ticket-raised-sort-options-index-nbfc li');
                if (sortOptions && sortOptions.length > 0) {
                    sortOptions.forEach(option => {
                        if (option) { // Check if option exists
                            option.classList.remove('active');
                            if (option.getAttribute('data-sort') === sortType) {
                                option.classList.add('active');
                            }
                        }
                    });
                }

                // Sort tickets based on selected option
                tickets.sort((a, b) => {
                    const titleA = a && a.getAttribute ? (a.getAttribute('data-title') || '') : '';
                    const titleB = b && b.getAttribute ? (b.getAttribute('data-title') || '') : '';
                    const dateA = a && a.getAttribute ? (a.getAttribute('data-date') || '') : '';
                    const dateB = b && b.getAttribute ? (b.getAttribute('data-date') || '') : '';

                    switch (sortType) {
                        case 'az':
                            return titleA.localeCompare(titleB);
                        case 'za':
                            return titleB.localeCompare(titleA);
                        case 'newest':
                            return new Date(dateB) - new Date(dateA);
                        case 'oldest':
                            return new Date(dateA) - new Date(dateB);
                        default:
                            return 0;
                    }
                });

                // Clear and rebuild the container safely
                if (ticketsContainer && ticketsContainer.firstChild) {
                    // Remove all tickets from container
                    while (ticketsContainer.firstChild) {
                        ticketsContainer.removeChild(ticketsContainer.firstChild);
                    }

                    // Reappend sorted tickets
                    tickets.forEach(ticket => {
                        if (ticket) { // Check if ticket exists
                            ticketsContainer.appendChild(ticket);
                        }
                    });
                }

                // Hide dropdown after selection - safely
                const dropdown = document.getElementById('ticket-raised-sort-options-index-nbfc');
                if (dropdown) {
                    dropdown.classList.remove('ticket-raised-visible');
                }

                // Don't try to update any status or result elements unless you confirm they exist
                // If you have code that updates a status element, add it here with proper null checks
            } catch (error) {
                console.error('Error in sortTickets function:', error);
            }
        }
      
        
 


   async function getTickets() {
        try {
             const response = await fetch('/get-tickets');

             if (!response.ok) {
                throw new Error('Network response was not ok');
            }

             const data = await response.json();

            // Debug: Log the response data
            console.log('Fetched data:', data);

            // Check if the response contains the tickets data
            if (data.success && Array.isArray(data.queries)) {
                const ticketContainer = document.getElementById('ticket-raised-tickets-list');
                ticketContainer.innerHTML = '';   

                data.queries.forEach(ticket => {
                     console.log('Created at:', ticket.created_at);

                     const ticketDateStr = ticket.created_at.split('.')[0];  
                    const ticketDate = new Date(ticketDateStr);  

                     const formattedDate = ticketDate instanceof Date && !isNaN(ticketDate)
                        ? ticketDate.toISOString().split('T')[0]
                        : 'Invalid Date';   

  
                    // Create the HTML structure for each ticket
                    const ticketItem = `
                    <div class="ticket-raised-item" data-title="${ticket.querytype}" data-date="${formattedDate}">
                        <div class="ticket-raised-content">
                            ${ticket.queryraised}                            

                             
                        </div>
                        <div class="ticket-raised-meta">
                         <div class="ticket-raised-meta-item-sc">Student Counsellor</div>
                    <div class="ticket-raised-meta-item-date">${formattedDate}</div>
                            <div class="ticket-raised-meta-item-student">${ticket.querytype || 'No Type'}</div>
                        </div>
                        <div class="ticket-raised-chat-icon-container">
                            <div class="ticket-raised-chat-icon">
                                <img src="assets/images/ticket-icon.png" alt="Message Icon" />
                            </div>
                        </div>
                    </div>
                `;

                    // Append the ticket item to the container
                    ticketContainer.innerHTML += ticketItem;
                });
            } else {
                console.error('No tickets found in the response');
            }
        } catch (error) {
            console.error('Failed to fetch tickets:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        getTickets();
    });



    </script>
</body>

</html>