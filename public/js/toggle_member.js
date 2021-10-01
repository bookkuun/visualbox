document
    .querySelector("#add_member")
    .addEventListener("click", function (event) {
        event.preventDefault();
        const member = document.querySelector('[data="member"]');
        const project_members = document.querySelector("#project_members");
        const new_member = member.cloneNode(true);
        new_member.classList.remove("hidden");
        new_member.classList.add("md:flex");
        const user = new_member.querySelector('[data="user"]');
        const user_authority = new_member.querySelector(
            '[data="user_authority"]'
        );
        user.name = `users[${project_members.children.length + 1}][id]`;
        user_authority.name = `users[${
            project_members.children.length + 1
        }][authority]`;
        project_members.appendChild(new_member);
    });

document
    .querySelector("#delete_member")
    .addEventListener("click", function (event) {
        event.preventDefault();
        const project_members = document.querySelector("#project_members");
        if (project_members.children.length == 0) {
            return;
        }
        project_members.lastChild.remove();
    });
