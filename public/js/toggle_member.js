document
    .querySelector("#add_member")
    .addEventListener("click", function (event) {
        event.preventDefault();
        const member_form = document.querySelector('[data="member_form"]');
        const project_members = document.querySelector("#project_members");
        const new_member = member_form.cloneNode(true);
        new_member.classList.remove("hidden");
        new_member.classList.add("flex");
        const member = new_member.querySelector('[data="member_id"]');
        const member_authority = new_member.querySelector(
            '[data="member_authority_id"]'
        );
        member.name = `users[${project_members.children.length + 1}][id]`;
        member_authority.name = `users[${
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
