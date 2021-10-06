const project_join_members = document.querySelectorAll(
    '[data="project_join_member"]'
);

project_join_members.forEach(function (element) {
    element.addEventListener("click", function (event) {
        event.preventDefault();

        if (
            window.confirm("プロジェクトからメンバーを削除してもよろしいですか")
        ) {
            const user_id = event.target.id;
            const project_id = location.pathname.split("/")[2];
            const csrf_token = document.head.querySelector(
                '[name="csrf-token"]'
            ).content;

            exitProjectApi();

            async function exitProjectApi() {
                const url = `/projects/${project_id}/users/${user_id}`;
                const params = {
                    method: "DELETE",
                    credentials: "same-origin",
                    headers: {
                        "X-CSRF-TOKEN": csrf_token,
                    },
                };

                const response = await fetch(url, params);
                const data = await response.json();
                const exit_member = document.querySelector(
                    `#join_member_${user_id}`
                );
                exit_member.remove();
            }
        }
    });
});
